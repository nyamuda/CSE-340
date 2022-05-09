/*TASK 1 */
INSERT INTO clients
VALUES
(DEFAULT,'Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n',DEFAULT, "I am the real Ironman");

/*TASK 2 */
UPDATE clients 
SET 
    clientLevel = 3
WHERE
    clientId = 1;
 
/*TASK 3 */
UPDATE inventory
SET
invDescription = REPLACE(invDescription,'small interior','spacious interior')
WHERE invId=12;


/*TASK 4 */
SELECT 
    invModel, classificationName
FROM
    inventory
        JOIN
    carClassification USING (classificationId)
WHERE
    classificationName = 'SUV';

/*TASK 5 */
DELETE FROM inventory
WHERE invId=1;

/*TASK 6 */
UPDATE inventory 
SET 
    invImage = CONCAT('/phpmotors', invImage),
    invThumbnail = CONCAT('/phpmotors', invThumbnail)
WHERE
    invId >= 1


