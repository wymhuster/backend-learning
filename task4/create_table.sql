-- -----------------------
-- table for user
-- -----------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `id`    int(11) unsigned   NOT NULL    AUTO_INCREMENT    COMMENT '用户ID',
    `name`    varchar(40)    NOT NULL   DEFAULT 'user'   COMMENT '用户名',
    `password`    varchar(100)    NOT NULL    DEFAULT '123456'   COMMENT '用户密码',
    `telephone_number`    varchar(100)    NOT NULL    DEFAULT '',
    `province`    varchar(100)    NOT NULL    DEFAULT '湖北武汉'    COMMENT '用户省份',
    `birthday`    date    NOT NULL    DEFAULT '1990-10-10'    COMMENT '用户生日',
    `gender`    tinyint(1)    NOT NULL    DEFAULT 0    COMMENT '用户性别 0代表男性 1代表女性',
    `created_at`    datetime    NOT NULL    DEFAULT CURRENT_TIMESTAMP    COMMENT '用户创建时间',
    `updated_at`    datetime    NOT NULL    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP    COMMENT '用户更新个人数据时间',
    primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------
-- table for receipt
-- -----------------------
DROP TABLE IF EXISTS `receipt`;
CREATE TABLE `receipt` (
    `id`    int(11) unsigned    NOT NULL    AUTO_INCREMENT    COMMENT '收货地址ID',
    `user_id`    int(11) unsigned   NOT NULL    DEFAULT 0    COMMENT '收货信息所属的用户ID',
    `address`    varchar(255)    NOT NULL    DEFAULT ''    COMMENT '用户的收货地址',
    `nickname`    varchar(40)    NOT NULL    DEFAULT ''    COMMENT '收货人昵称',
    `telephone_number`    varchar(100)    NOT NULL    DEFAULT ''    COMMENT '收货人电话',
    `is_deleted`    tinyint    NOT NULL    DEFAULT 1    COMMENT '0代表地址被删除  1代表未删除',
    `created_at`    datetime    NOT NULL    DEFAULT CURRENT_TIMESTAMP    COMMENT '地址创建时间',
    `updated_at`    datetime    NOT NULL    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP    COMMENT '地址更新时间',
    primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------
-- table for shop
-- -----------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
    `id`    int(11) unsigned    NOT NULL    AUTO_INCREMENT    COMMENT '商铺ID',
    `shop_name`    varchar(40)    NOT NULL    DEFAULT ''    COMMENT '商铺名',
    `user_id`    int(11) unsigned    NOT NULL    DEFAULT 0    COMMENT '商铺主人ID',
    `level`    tinyint    NOT NULL    DEFAULT 1    COMMENT '商铺等级',
    `is_deleted`    tinyint    NOT NULL    DEFAULT 1 COMMENT '0代表商铺被删除  1代表未删除',       
    `created_at`    datetime    NOT NULL    DEFAULT CURRENT_TIMESTAMP    COMMENT '商铺创建时间',
    `updated_at`    datetime    NOT NULL    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP    COMMENT '商铺更新信息时间',
    primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------
-- table for goods
-- -----------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
    `id`    int(11) unsigned    NOT NULL    AUTO_INCREMENT    COMMENT '商品ID',
    `goods_name`    varchar(100)    NOT NULL    DEFAULT ''    COMMENT '商品名',
    `price`    float(6,2)    NOT NULL    DEFAULT 9999.99    COMMENT '商品价格',
    `shop_id`    int(11) unsigned    NOT NULL    DEFAULT 0    COMMENT '商品所属于的商店的ID',
    `number_stock`    int unsigned    NOT NULL    DEFAULT 1    COMMENT '商品库存数目',
    `number_presale`    int unsigned    NOT NULL    DEFAULT 0    COMMENT '商品预售数目',
    `is_deleted`    tinyint    NOT NULL    DEFAULT 1 COMMENT '0代表商品被删除  1代表未删除', 
    `created_at`    datetime    NOT NULL    DEFAULT CURRENT_TIMESTAMP    COMMENT '商品创建时间',
    `updated_at`    datetime    NOT NULL    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP    COMMENT '商品更新时间',
    primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------
-- table for order
-- -----------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
    `id`    int(11) unsigned    NOT NULL    AUTO_INCREMENT    COMMENT '订单ID',
    `user_id`    int(11) unsigned    NOT NULL    DEFAULT 0    COMMENT '下订单的用户ID',
    `address`    varchar(255)    NOT NULL    DEFAULT ''    COMMENT '订单收货地',
    `nickname`    varchar(40)    NOT NULL    DEFAULT ''    COMMENT '收货人昵称',
    `telephone_number`    varchar(100)    NOT NULL    DEFAULT ''    COMMENT '收货人电话',
    `created_at`    datetime    NOT NULL    DEFAULT CURRENT_TIMESTAMP    COMMENT '订单创建时间',
    `updated_at`    datetime    NOT NULL    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP    COMMENT '订单更新时间',    
    primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------
-- table for orderitem
-- -----------------------
DROP TABLE IF EXISTS `orderitem`;
CREATE TABLE `orderitem` (
    `id`    int(11) unsigned    NOT NULL    AUTO_INCREMENT    COMMENT '订单商品ID',
    `order_id`    int(11) unsigned    NOT NULL    DEFAULT 0    COMMENT '订单ID',
    `goods_id`    int(11) unsigned    NOT NULL    DEFAULT 0    COMMENT '商品ID',
    `quantity`    int unsigned    NOT NULL    DEFAULT 1    COMMENT '商品数目',
    `price`    float(6,2)    NOT NULL    DEFAULT 9999.99    COMMENT '下订单时的商品价格',
    `created_at`    datetime    NOT NULL    DEFAULT CURRENT_TIMESTAMP    COMMENT '订单商品创建时间',
    `updated_at`    datetime    NOT NULL    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP    COMMENT '订单商品更新时间',
    primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
