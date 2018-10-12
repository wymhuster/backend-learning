#创建数据库
CREATE DATABASE task;
USE task;
    
#创建用户表
CREATE TABLE users(
    user_id    INT UNSIGNED   NOT NULL    AUTO_INCREMENT,
	user_name    CHAR(20)    NOT NULL,
    password    CHAR(18)    NOT NULL,
    gender    BIT(1)   NOT NULL    DEFAULT b'1',
    birthday    DATE    NOT NULL,
    address    CHAR(120),
	receipt_addr    CHAR(120),
	PRIMARY KEY (user_id)    
)ENGINE=InnoDB;

#创建商铺表
CREATE TABLE shops(
	shop_id    INT UNSIGNED    NOT NULL    AUTO_INCREMENT,
	shop_name    CHAR(24)    NOT NULL,
	shop_createdate    DATE    NOT NULL,
	level    TINYINT    NOT NULL    DEFAULT 1,
	PRIMARY KEY (shop_id)
)ENGINE=InnoDB;

#创建商品表
CREATE TABLE goods(
	goods_id    INT UNSIGNED    NOT NULL    AUTO_INCREMENT,
	goods_name    CHAR(60)    NOT NULL,
	price    FLOAT(6,2)    NOT NULL,
	shop_id    INT UNSIGNED    NOT NULL,
	PRIMARY KEY (goods_id)
)ENGINE=InnoDB;

#创建订单表
CREATE TABLE orders(
	order_id    INT UNSIGNED    NOT	NULL    AUTO_INCREMENT,
	user_id    INT UNSIGNED    NOT NULL,
	order_date	DATETIME	NOT NULL,
	order_address    CHAR(120)    NOT NULL,
	PRIMARY KEY (order_id)
)ENGINE=InnoDB;

#创建订单详细表
CREATE TABLE orderitems(
	order_id    INT UNSIGNED    NOT NULL,
	order_turn    TINYINT UNSIGNED    NOT NULL,
	goods_id	INT UNSIGNED    NOT NULL,
	quantity	INT UNSIGNED    NOT NULL,
	price    FLOAT(6,2)    NOT NULL,
	PRIMARY KEY (order_id, order_turn)
)ENGINE=InnoDB;

#创建商品库存表
CREATE TABLE stocks(
	goods_id    INT UNSIGNED    NOT NULL,
	num_reserve    INT UNSIGNED    NOT NULL,
	presales    INT UNSIGNED    NOT NULL    DEFAULT 0,
	PRIMARY KEY (goods_id)
)ENGINE=InnoDB;

ALTER TABLE goods ADD CONSTRAINT fk_goods_shops FOREIGN KEY (shop_id) REFERENCES shops(shop_id);
ALTER TABLE orders ADD CONSTRAINT fk_orders_users FOREIGN KEY (user_id) REFERENCES users(user_id);
ALTER TABLE orderitems ADD CONSTRAINT fk_orderitems_orders FOREIGN KEY (order_id) REFERENCES orders(order_id);
ALTER TABLE stocks ADD CONSTRAINT fk_stocks_goods FOREIGN KEY (goods_id) REFERENCES goods(goods_id);
