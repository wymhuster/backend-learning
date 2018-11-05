-- ----------------
-- 插入数据到商店
-- ---------------

INSERT INTO `shop` (`shop_name`, `user_id`) VALUES ('youyiku', 1);
INSERT INTO `shop` (`shop_name`, `user_id`) VALUES ('hailanzhijia', 1);
INSERT INTO `shop` (`shop_name`, `user_id`) VALUES ('yipintiancheng', 1);
INSERT INTO `shop` (`shop_name`, `user_id`) VALUES ('youyikuxiaohao', 2);
INSERT INTO `shop` (`shop_name`, `user_id`) VALUES ('hailanzhijiaxiaohao', 2);
INSERT INTO `shop` (`shop_name`, `user_id`) VALUES ('yipintianchengxiaohao', 2);
INSERT INTO `shop` (`shop_name`, `user_id`) VALUES ('youyikux', 3);
INSERT INTO `shop` (`shop_name`, `user_id`) VALUES ('hailanzhijiax', 3);
INSERT INTO `shop` (`shop_name`, `user_id`) VALUES ('yipintianchengx', 3);


-- ----------------
-- 插入数据到收货地址
-- ---------------
INSERT INTO `receipt` (`user_id`, `address`, `nickname`, `telephone_number`) VALUES (5, 'shanxi', 'xiaohua', '123456789');
INSERT INTO `receipt` (`user_id`, `address`, `nickname`, `telephone_number`) VALUES (6, 'shanxi', 'xiaohong', '123456789');
INSERT INTO `receipt` (`user_id`, `address`, `nickname`, `telephone_number`) VALUES (7, 'shanxi', 'xiaoming', '123456789');


-- ----------------
-- 插入数据到商品
-- --------------- 
INSERT INTO `goods` (`goods_name`, `price`, `shop_id`, `number_stock`) VALUES ('nanzhuang1', 9.99, 1, 99);
INSERT INTO `goods` (`goods_name`, `price`, `shop_id`, `number_stock`) VALUES ('nanzhuang2', 9.99, 1, 99);
INSERT INTO `goods` (`goods_name`, `price`, `shop_id`, `number_stock`) VALUES ('nanzhuang3', 9.99, 1, 99);
INSERT INTO `goods` (`goods_name`, `price`, `shop_id`, `number_stock`) VALUES ('nvzhuang1', 9.99, 2, 99);
INSERT INTO `goods` (`goods_name`, `price`, `shop_id`, `number_stock`) VALUES ('nvzhuang1', 9.99, 2, 99);
INSERT INTO `goods` (`goods_name`, `price`, `shop_id`, `number_stock`) VALUES ('nvzhuang1', 9.99, 2, 99);
INSERT INTO `goods` (`goods_name`, `price`, `shop_id`, `number_stock`) VALUES ('tongzhuang1', 9.99, 3, 99);
INSERT INTO `goods` (`goods_name`, `price`, `shop_id`, `number_stock`) VALUES ('tongzhuang1', 9.99, 3, 99);
INSERT INTO `goods` (`goods_name`, `price`, `shop_id`, `number_stock`) VALUES ('tongzhuang1', 9.99, 3, 99);
INSERT INTO `goods` (`goods_name`, `price`, `shop_id`, `number_stock`) VALUES ('dayi1', 9.99, 4, 99);
INSERT INTO `goods` (`goods_name`, `price`, `shop_id`, `number_stock`) VALUES ('dayi1', 9.99, 4, 99);
INSERT INTO `goods` (`goods_name`, `price`, `shop_id`, `number_stock`) VALUES ('dayi1', 9.99, 4, 99);


-- ----------------
-- 插入数据到订单
-- ---------------
INSERT INTO `order` (`user_id`, `address`, `nickname`, `telephone_number`) VALUES (5, 'shanxi', 'xiaohua', '123456789');
INSERT INTO `order` (`user_id`, `address`, `nickname`, `telephone_number`) VALUES (6, 'shanxi', 'xiaohong', '123456789');
INSERT INTO `order` (`user_id`, `address`, `nickname`, `telephone_number`) VALUES (7, 'shanxi', 'xiaoming', '123456789');


-- ----------------
-- 插入数据到订单
-- ---------------
INSERT INTO `orderitem` (`order_id`, `goods_id`, `price`) VALUES (1, 1, 9.99);
INSERT INTO `orderitem` (`order_id`, `goods_id`, `price`) VALUES (1, 2, 9.99);
INSERT INTO `orderitem` (`order_id`, `goods_id`, `price`) VALUES (1, 3, 9.99);
INSERT INTO `orderitem` (`order_id`, `goods_id`, `price`) VALUES (2, 4, 9.99);
INSERT INTO `orderitem` (`order_id`, `goods_id`, `price`) VALUES (2, 5, 9.99);
INSERT INTO `orderitem` (`order_id`, `goods_id`, `price`) VALUES (2, 6, 9.99);
INSERT INTO `orderitem` (`order_id`, `goods_id`, `price`) VALUES (3, 7, 9.99);
INSERT INTO `orderitem` (`order_id`, `goods_id`, `price`) VALUES (3, 8, 9.99);
INSERT INTO `orderitem` (`order_id`, `goods_id`, `price`) VALUES (3, 9, 9.99);