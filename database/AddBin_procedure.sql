SELECT * from bins;
SELECT * from approved;

DROP PROCEDURE addBin;
CALL addBin('Varna',45.123456,44.123456);

DELIMITER //
CREATE PROCEDURE addBin(IN address varchar(255), IN lat float(10,6), IN lng float(10,6))
    
BEGIN

DECLARE valid int;
DECLARE roll BOOL DEFAULT 0;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET roll = 1;

START TRANSACTION;

IF (SELECT EXISTS(SELECT 1 FROM Approved)) = 1

THEN 
SET @q_id := (SELECT Q_id FROM Approved ORDER BY Votes DESC LIMIT 1);
SET @question := (SELECT Question FROM Approved WHERE Q_id = @q_id);
SET @a_right := (SELECT A_Right FROM Approved WHERE Q_id = @q_id);
SET @a_left:= (SELECT A_Left FROM Approved WHERE Q_id = @q_id);
DELETE FROM Approved WHERE Q_id = @q_id;

ELSE

SET @question := 'How do you feel?';
SET @a_right := 'Good';
SET @a_left:= 'Bad';

END IF;

INSERT INTO Bins (Question, A_Right, A_Left, Published, Address, Latitude, Longitude)
VALUES (@question, @a_right, @a_left, CURDATE(), address, lng, lat);

IF roll THEN
	ROLLBACK;
    SET valid = 0;
ELSE
	COMMIT;
    SET valid = 1;
END IF;

SELECT valid;

END //
DELIMITER ;
 
