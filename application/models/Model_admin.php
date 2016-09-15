<?php 
class Model_admin extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_user()
	{
		$sql = "SELECT q.*
				FROM
				(
					SELECT q1.`total`,q1.`tipe` 
					FROM 
					(
						SELECT COUNT(*) AS 'total', 'ALL' AS tipe
						FROM user
					) AS q1
					UNION
					SELECT q2.`total`,q2.`tipe`
					FROM
					(
						SELECT COUNT(*) AS 'total', 'FACEBOOK' AS tipe
						FROM user
						WHERE user_facebook != ''
					) AS q2
					UNION
					SELECT q3.`total`,q3.`tipe`
					FROM
					(
						SELECT COUNT(*) AS 'total', 'TWITTER' AS tipe
						FROM user
						WHERE user_twitter != ''
					)AS q3
					UNION
					SELECT q4.`total`,q4.`tipe`
					FROM
					(
						SELECT COUNT(q.l_id) AS 'total', q.tipe
						FROM
						(
							SELECT l_id, l_sess_id,'QUIZ' AS tipe
							FROM log_answer
							WHERE l_user_id != 0
							GROUP BY l_user_id
						) AS q
					)AS q4
				) AS q";
		$q = $this->db->query($sql);
		$res = array();
		
		if($q->num_rows() > 0) {
			foreach($q->result_array() as $result) {
				$res[$result['tipe']] = $result['total'];
			}
		}
		return $res;				
	}
	
	function countResult($limit=100,$offset=0) {
		$sql = "SELECT * FROM log_answer WHERE l_flag = 1 GROUP BY l_sess_id ORDER BY l_id ASC LIMIT $limit OFFSET $offset";
		$q = $this->db->query($sql);
		
		$arr_result1 = array();
		$arr_result2 = array();
		$arr_result3 = array();
		$translated = NULL;
		if($q->num_rows() > 0) {
			foreach($q->result_array() as $res) {
				$result = $this->getResult($res['l_sess_id']);
				/*
				if($result['row']['l_answer_value'] == 1) {
					$arr_result1[] = $res['l_sess_id'];
				}
				else if($result['row']['l_answer_value'] == 2) {
					$arr_result2[] = $res['l_sess_id'];
				}
				else if($result['row']['l_answer_value'] == 3) {
					$arr_result3[] = $res['l_sess_id'];
				}*/
				
				switch($result['row']['l_answer_value']){
					case 1 : $translated = 'ESCAPE'; break;
					case 2 : $translated = 'GETAWAY'; break;
					case 3 : $translated = 'SURPRISE'; break;
					default : break;
				}
				
				$arr_ins = array(
					'ra_sess_id'=>$res['l_sess_id'],
					'ra_user_id'=>$res['l_user_id'],
					'ra_result'=>$translated
				);
				
				$this->db->insert('result_answer', $arr_ins);
			}
		}
		
		/*
		$jml = array(
			'1.ESCAPE'=>count($arr_result1),
			'2.GETAWAY'=>count($arr_result2),
			'3.SURPRISE'=>count($arr_result3)
			);
			
		return $jml;
		*/
	}
	
	function countResult2() {
		$sql = "SELECT COUNT(*) AS jml, ra_result
				FROM result_answer 
				GROUP BY ra_result";
		$q = $this->db->query($sql);
		$res = array();
		
		if($q->num_rows() > 0) {
			foreach($q->result_array() as $result) {
				$res[$result['ra_result']] = $result['jml'];
			}
		}
		return $res;
	}
	
	function getResult($sess_id=NULL) {
		if($sess_id != NULL) {
			$sql = "
					SELECT q.l_sess_id, q.l_user_id, q.l_answer_value, q.count_answer
					FROM
					(
					    SELECT a.l_sess_id, a.l_user_id, a.l_answer_value, COUNT(a.l_answer_value) AS count_answer, b.*
					    FROM `log_answer` AS a
					    LEFT JOIN `user` As b ON a.l_user_id = b.id
					    WHERE a.l_flag = 1 
					    AND a.l_sess_id = '$sess_id' 
					    GROUP BY a.l_sess_id, a.l_answer_value
					) AS q
					WHERE q.count_answer = 
					(
						SELECT MAX(x.count_answer)
						FROM 
						(
					    	SELECT a.l_sess_id, a.l_user_id, a.l_answer_value, COUNT(a.l_answer_value) AS count_answer, b.*
					        FROM `log_answer` AS a
					        LEFT JOIN `user` As b ON a.l_user_id = b.id
					        WHERE a.l_flag = 1
					        AND a.l_sess_id = '$sess_id' 
					        GROUP BY a.l_sess_id, a.l_answer_value
					    )AS x   
					)";
			
			$q = $this->db->query($sql);

			$return['row'] = $q->row_array();
			$return['sql'] = $sql;

			return $return;
		}
	}
}