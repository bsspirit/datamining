USE competition;

CREATE VIEW v_quiz AS
	SELECT q.id,q.title,q.create_date,q.end_date,q.owner_id,u.name as owner_name,if(sum(s.result),sum(s.result),0) AS correct,count(s.id) AS count
	FROM t_quiz q 
	LEFT JOIN t_user u ON q.owner_id=u.id
	LEFT JOIN t_quiz_submit s ON s.qid=q.id
	GROUP BY q.id
	ORDER BY id ASC	


CREATE VIEW v_quiz_status AS
	SELECT s.id,s.qid,q.title,s.create_date,s.lang,s.status,s.result,s.player_id,u.name as player_name,length(s.code) as code_length
	FROM t_quiz_submit s
	LEFT JOIN t_quiz q ON s.qid=q.id
	LEFT JOIN t_user u ON s.player_id=u.id
	ORDER BY s.create_date DESC;