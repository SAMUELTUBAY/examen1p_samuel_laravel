DELIMITER //

CREATE PROCEDURE SP_INS_EQUIPOS(
   IN PV_NOMBRE_EQUIPO VARCHAR(50),
   IN PV_DESCRIPCION VARCHAR(50),
   IN PV_NUMERO_JUGADORES VARCHAR(50),
   IN PV_PAIS VARCHAR(50),
   IN PV_FALTAS VARCHAR(50),
   IN PV_CIUDAD VARCHAR(50),
   IN PV_ESTADIO VARCHAR(50)
)
BEGIN
   DECLARE CONTADOR_ID INT DEFAULT 0;

   SELECT COUNT(*) INTO CONTADOR_ID
   FROM EQUIPOS
   WHERE NOMBRE_EQUIPO = PV_NOMBRE_EQUIPO;

   IF CONTADOR_ID = 0 THEN
       INSERT INTO EQUIPOS(NOMBRE_EQUIPO, DESCRIPCION, NUMERO_JUGADORES, PAIS, FALTAS, CIUDAD, ESTADIO)
       VALUES(PV_NOMBRE_EQUIPO, PV_DESCRIPCION, PV_NUMERO_JUGADORES, PV_PAIS, PV_FALTAS, PV_CIUDAD, PV_ESTADIO);
   END IF;
END //

DELIMITER ;