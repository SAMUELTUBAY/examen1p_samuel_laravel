DELIMITER //

CREATE PROCEDURE SP_GET_FUTBOLISTAS()
BEGIN
   SELECT * 
   FROM FUTBOLISTA;
END //

DELIMITER ;