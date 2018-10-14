# mysql
标签（空格分隔）： mysql




[TOC]



------------------------------------------------------
**创建用户并赋予权限**
------------------------------------------------------
``` 
    CREATE USER user_name IDENTIFIED BY user_password;
    GARNT priveleges ON items TO user_name; 
```

-------------------------------------------------------
**回收用户权限和删除用户**
-------------------------------------------------------
``` 
    REVOKE privileges ON items FROM user_name;
    DROP USER user_name;
```
-------------------------------------------------------
**创建和操作数据库**
-------------------------------------------------------
```
    CREATE DATABASE dbname;
    USE dbname;
    DROP DATABASE dbname;
```
------------------------------------------------------- 
**操作数据库表**
-------------------------------------------------------
``` 
    CREATE TABLE table_name (columns); 
    DROP TABLE table_name;
    RENAME TABLE table_name TO new_table_name;      //重命名数据库表
    ALTER TABLE table_name ADD new_col data_type;       //添加新列
    ALTER TABLE table_name DROP COLUMN col;         //删除列
```

数据库表的主键是该表的唯一性索引。

-------------------------------------------------------
**外键**
-------------------------------------------------------

外键为某个表中的某一列，它包含另一个表的主键值，定义了两个表的关系。
    
```
    ALTER TABLE table1
    ADD CONSTRAINT fk_name
    FOREIGN KEY (col1) REFERENCRS table2 (col2);
```


-------------------------------------------------------
**查看数据库列表**
-------------------------------------------------------
``` 
    SHOW DATABASES;
```
-------------------------------------------------------
**查看特定表的详细信息**
-------------------------------------------------------
``` 
    DESCRIBE table_name;
```
-------------------------------------------------------
**插入数据**
-------------------------------------------------------
```
    INSERT INTO table_name (col1, col2, col3, ...) VALUES 
    (val1, val2, val3, ...) ;
    INSERT INTO table_name VALUES  //需和原表定义的列一一对应
    (val1, val2, val3, ...); 
    INSERT INTO table_name 
    set col1 = val1, 
        col2 = val2, 
        ... = ... ;
```
 在插入数据时可以插入检索出的数据
```
    INSERT INTO table_name (col1, col2, col3, ...) 
    SECECT val1, val2, val3, ...
    FROM ano_table;
```

-------------------------------------------------------
**检索数据**
-------------------------------------------------------
```
    SELRCT col1, col2, col3, ...        //使用*可以查看所有列
    FROM table_name;
```

1. 在检索时可以使用`LIMIT num1, num2`来限制输出的行数，表示从第`num1`行开始输出`num2`行（mysql第一行为行0）。
2. 在检索时可以使用`ORDER BY col1, col2, ... `来使用按顺序升序排列，`BY DESC`来降序排列，对多列降序时需对每一列都指定`DESC`关键词，一般`ORDER BY`需放于`LIMIT`之前。
3. 在检索时可以使用`WHERE`子句对检索进行过滤，`AND`的优先级高于`OR`。
4. 在mysql中`NULL`代表为空，与`0 or ''`不同，不代表值，所以在ANSI SQL严格标准下不能用`=`和`!=`对它进行判断，只能使用`IS`和`IS NOT`进行判断。

**LIKE和REGEXP操作符**
```
    SELRCT col1       
    FROM table_name
    WHERE col1 LIKE expression;
    SELRCT col1        
    FROM table_name
    WHERE col1 REGEXP expression;
```

 1. LIKE匹配整个列，如果被匹配的文本在列值中出现，则不会找到，也不会返回。而REGEXP在列值中进行匹配，如果被匹配的文本在列值中出现，相应的行会被返回。
 2. REGEXP匹配特殊字符，必须用\\\\做先导。\\\\.表示查找.

**函数和聚集函数**

 1. mysql有内置的对数据进行处理的函数
 2. mysql对汇总数据内置了聚集函数，`count(*)`会对所以行计数（包括为NULL的列），而`count(col)`会忽略`NULL`
 3. 若在聚集时只要不同值，可用`DISTINCT`指定参数

**分组数据**
```
    SELRCT col1, col2, col3, ...       
    FROM table_name
    GROUP BY col1;
```
对于分组数据可使用`HAVING`关键字进行过滤分组

-------------------------------------------------------
**联结**
-------------------------------------------------------
```
    SELECT table1.col1, table1.col2, table2.col1, table.col2        //内联结or等值联结
    FROM table1 INNER JOIN table2
    ON table1.col = table2.col;
    SELECT table1.col1, table1.col2, table2.col1, table.col2        //left join
    FROM table1 LEFT OUTER JOIN table2
    ON table1.col = table2.col;
    SELECT table1.col1, table1.col2, table2.col1, table.col2        //right join
    FROM table1 RIGHT OUTER JOIN table2
    ON table1.col = table2.col;
    SELECT table1.col1, table1.col2, table2.col1, table.col2        //full outer join
    FROM table1 FULL OUTER JOIN table2
    ON table1.col = table2.col;
```

1. 内部联结会返回两个表中严格匹配表达式的行，相当于A∩B
2. `left join`会返回左边和右边表中严格遵循表达式的行和左边没有匹配的行，相当于A∪(A∩B)
3. `right join`和`left join`相似，相当于`left join`调换了左右顺序，会返回右边没有匹配的行
4. `full outer join`会返回左表和右表所有的行，相当于A∪B
 
-------------------------------------------------------
**组合查询**
-------------------------------------------------------
```
    SELECT col1, col2, col3
    FROM table1
    WHREE expression1
    UNION
    SELECT col4,col5,col6
    FORM table2
    WHERE expression2
```

使用组合查询时可以返回多个检索返回的数据结构相似的结果，`UNION ALL`会返回重复值

-------------------------------------------------------
**更新和删除数据**
-------------------------------------------------------
```
    UPDATE table_name
    SET col1 = val1,
        col2 = val2
    WHERE expression;
    DELETE FROM table_name
    WHERE expression;
```

------------------------------------------------------
**索引操作**
---- 
```
    CREATE [UNIQUE] INDEX index_name ON table(col);
    ALTER TABLE table_name ADD INDEX index_name(col);
```
1. 主键索引一般在创建表时指定，且主键要求值唯一且不能为`NULL`
2. 唯一索引要求值唯一但值可以为`NULL`
3. 组合索引一般采用最左前缀原则，遇到范围查询就停止匹配


------------------------------------------------------
**性能优化**
---------------------------------------------------
1. 对于查询速度，可以在关键字段设置索引，如经常会用到的字段，users表的user_name，goods的goods_name， orderitems的goods_id，orders的user_id，shops的shop_name
2. 对于存储可以减少一些不必要的字段，如orders的总金额，可通过orderitems的数量和价格计算，对于一些不需要大数据类型的列采用小数据类型，如性别可以采用bit(1)，对于一些字符列可以使用比较短的字符，如果不需要utf-8字符集的话可以使用gbk或latin1，对于不必要的列不要设索引也可以减少存储
3. 在不必要的时候尽量少使用字符类型，尽量使用整型数据