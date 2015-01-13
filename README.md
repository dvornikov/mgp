## Задание 1:
```mysql
SELECT DepartmentName, COUNT(*)
FROM employee,department
WHERE employee.DepartmentID = department.DepartmentID
GROUP BY DepartmentName
HAVING COUNT(*)>1 -- Исправление
```
## Задание 3 (А и Б объединены в коде)
dump.sql — тестовые данные и схема базы.

логины пользователей: user1, user2, user3
пароли у всех: 1234567
