#向数据库中添加数据并进行查询、更新和删除

USE task;

DELIMITER //

CREATE PROCEDURE createusers(
    IN num INT
)
BEGIN 
    DECLARE i INT DEFAULT 0;

    WHILE i<num DO
        INSERT INTO users (user_name, password, birthday) VALUES (Concat('user',i), Concat('password',i), CurDate());
        SET i = i + 1;
    END WHILE;
END //

CREATE PROCEDURE createshops(
    IN num INT
)
BEGIN 
    DECLARE  i INT DEFAULT 0;
    WHILE i<num DO
        INSERT INTO shops(shop_name, shop_createdate) VALUES (Concat('shop',i+1), CurDate());
        SET i=i+1;
    END WHILE;
END //

CREATE PROCEDURE creategoods(
    IN num INT
)
BEGIN
    DECLARE m INT DEFAULT 1;
    WHILE m<num+1 DO
        INSERT INTO goods(goods_name, price, shop_id) VALUES (Concat('goods',m+1), 19.99, ((m)%200)+1);
        set m=m+1;
    END WHILE;
END //

CREATE PROCEDURE createorders(
    IN num INT
)
BEGIN
    DECLARE n INT DEFAULT 0;
    WHILE n<num DO
        INSERT INTO orders(user_id, order_date, order_address) VALUES (n+1, Now(), 'default address');
        SET n=n+1;
    END WHILE;
END //

CREATE PROCEDURE createstocks(
    IN num INT
)
BEGIN 
    DECLARE p INT DEFAULT 0;
    WHILE p<num DO
        INSERT INTO stocks(goods_id, num_reserve) VALUES (p+1, 255);
        SET p = p+1;
    END WHILE;
END //

CREATE PROCEDURE createorderitems(
    IN id INT
)
BEGIN 
    DECLARE q INT DEFAULT 0;
    WHILE q<200 DO
        INSERT INTO orderitems(order_id, order_turn, goods_id, quantity, price) VALUES (q+1, id, q*10+id, q+1, 19.99);
        SET q=q+1;
    END WHILE;
END //

DELIMITER ;


#创建2000用户，200商铺，2000商品,200订单(每个10货物)
CALL createusers(2000);
CALL createshops(200);
CALL creategoods(2000);
CALL createstocks(2000);
CALL createorders(200);
CALL createorderitems(1);
CALL createorderitems(2);
CALL createorderitems(3);
CALL createorderitems(4);
CALL createorderitems(5);
CALL createorderitems(6);
CALL createorderitems(7);
CALL createorderitems(8);
CALL createorderitems(9);
CALL createorderitems(10);

#添加索引
ALTER TABLE users ADD INDEX index_users_username(user_name);
ALTER TABLE goods ADD INDEX index_goods_shopid(goods_name, shop_id);
ALTER TABLE orderitems ADD INDEX index_orderitems_goodsid(goods_id);
ALTER TABLE orders ADD INDEX index_orders_userid(user_id);
ALTER TABLE shops ADD INDEX index_shops_shopname(shop_name);


#查询数据
SELECT * FROM orders WHERE order_id in (SELECT order_id FROM orderitems WHERE quantity>198);
SELECT g1.* FROM goods AS g1, goods AS g2 WHERE g1.shop_id=g2.shop_id AND g2.goods_id=4;
SELECT users.user_id, users.user_name, orders.order_id FROM users LEFT OUTER JOIN orders ON users.user_id=orders.user_id ORDER BY user_id limit 190,20;
SELECT user_id FROM users WHERE user_name<'user10' UNION SELECT user_id FROM orders WHERE order_id BETWEEN 100 AND 105;
SELECT count(*) FROM users;
UPDATE users SET user_name='xiaoming', password='xiaoming123' WHERE user_id=1; 
UPDATE goods SET goods_name='milk', price=29.99 WHERE goods_id=1;
UPDATE goods SET price=6.66 WHERE shop_id=4;
DELETE FROM users WHERE user_name='user1999';