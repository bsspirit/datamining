USE competition;

/*quiz基础视图*/
CREATE VIEW v_quiz_basic AS
	SELECT q.id,q.title,q.create_date,q.category,q.owner_id,u.name AS owner_name,st.status
	FROM t_quiz q,t_quiz_status st,t_user u
	WHERE q.id=st.qid
	AND q.owner_id=u.id
	AND st.status!='DELETE';

/*quiz带统计信息的视图*/
CREATE VIEW v_quiz AS
	SELECT t.id,t.title,t.create_date,t.owner_id,u.name AS owner_name,t.category,
	(
		SELECT count(s.result) AS currect
		FROM t_quiz_submit s
		WHERE s.qid= t.id  AND (s.result = 'CORRECT' || (result='PROBABILITY' AND s.prob>80))
	) AS currect,
	(
		SELECT count(s.id) AS count
		FROM t_quiz_submit s
		WHERE s.qid=t.id 
	) AS count
	FROM t_quiz t LEFT JOIN t_user u ON t.owner_id=u.id
	GROUP BY t.id
	ORDER BY t.id ASC;

/*quiz状态视图*/
CREATE VIEW v_quiz_status AS
	SELECT s.id,s.qid,q.title,s.create_date,s.lang,s.status,s.result,s.player_id,u.name as player_name,length(s.code) as code_length,q.category
	FROM t_quiz_submit s
	LEFT JOIN t_quiz q ON s.qid=q.id
	LEFT JOIN t_user u ON s.player_id=u.id
	ORDER BY s.create_date DESC;

/*role视图*/
CREATE VIEW v_user_role AS
	SELECT u.id,u.name,u.email,group_concat(r.itemname) as role,u.create_date
	FROM t_user u, authassignment r
	WHERE u.id=r.userid
	GROUP BY name
	ORDER BY id ASC;