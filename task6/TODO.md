# JavaScript
### 1. 初识JavaScript
- [学习W3School的Javascript教程](http://www.w3school.com.cn/js/index.asp)（页面左侧“课程表”的“JS教程”“JS对象”部分）

### 2. JavaScript 基础

- [JavaScript 指南](https://developer.mozilla.org/zh-CN/docs/Web/JavaScript/Guide)
    - 介绍
    - 语法与数据类型
    - 控制流与错误处理
    - 循环与迭代
    - 函数
    - 表达式和运算符
    - 数字和日期
    - 文本格式化
    - 索引集合
    - 处理对象
    - 迭代器与生成器

不需要看的太仔细，有很多地方第一部分提到了，这里主要是为了让你对ES6以及一些特性有个概念，学到后面如果有不熟悉的地方可以翻文档。

### 3. JavaScript 进阶
- 理解 this 和 对象原型(prototype) 的概念，推荐阅读 [你不知道的JavaScript 上册](http://www.ituring.com.cn/book/1488)
- 系统学习 ES6，推荐阅读 [ES6 入门](http://es6.ruanyifeng.com/)
    - 2，3，4，5，6，7，8，9，14，15，16，17，18 章

# Node.js

### 1. Node.js 基础

- [廖雪峰的Node教程](https://www.liaoxuefeng.com/wiki/001434446689867b27157e896e74d51a89c25cc8b43bdb3000/001434501245426ad4b91f2b880464ba876a8e3043fc8ef000)

学习过程中做到以下几点：
- 了解 node npm 命令行用法；了解 package.json 的结构
- 重点理解 [CommonJS 规范](http://javascript.ruanyifeng.com/nodejs/module.html)
- 使用 VSCode 打断点调试代码
- 理解 [http 模块用法](http://javascript.ruanyifeng.com/nodejs/http.html)
- 理解 [Koa 框架用法](http://javascript.ruanyifeng.com/nodejs/koa.html)

### 2. Node.js 理解

- 推荐阅读 深入浅出 Node.js 的部分章节
- 理解事件循环、异步I/O机制，理解 Node.js 为什么非常适合 IO 密集的业务场景
- Node.js 异步编程的三个阶段：
    - 回调  
    - generator + yield 
    - async + await

### 3. Node.js 进阶

- 在项目中使用各种 node_modules，感兴趣的话可以阅读一些 modules 的源码。推荐阅读 koa2 的源码，短小精悍。
- 在项目中加深认识

# MongoDB

### 1. MongoDB 基础
- [菜鸟教程](http://www.runoob.com/mongodb/mongodb-tutorial.html)
    - 从 NoSQL 简介 到 MongoDB 聚合
- 试着用 MongoDB 的集合重新设计 MySQL 教程中的电商数据表。理解 MongoDB 的灵活性。体会 MongoDB 和 MySQL 分别适合哪些业务场景
    
### 2. MongoDB 进阶
- [MongoDB 设计原则](https://docs.mongodb.com/manual/core/data-model-design/)
- [MongoDB 索引](https://docs.mongodb.com/manual/indexes/)
    - 单字段索引
    - 复合索引
    - 多键索引
    - [索引属性](https://docs.mongodb.com/manual/core/index-ttl/)
- [MongoDB 事务](https://docs.mongodb.com/manual/core/transactions/) 事务是MongoDB v4.0 新加的特性，在某些业务场景下很有用，现在线上还没有升级，之后会考虑升级的
- [副本集](https://docs.mongodb.com/manual/replication/)和[分片](https://docs.mongodb.com/manual/sharding/)，由于实验室部署了 MongoDB 的服务器目前就一台，可以暂时只是了解

### 2. mongoose 库

mongo 官方的 Node.js 库用的还是 yield + generator 的异步模型，mongoose 是对官方库的封装，api使用起来更顺手，可以支持 async + await，所以项目还是用的mongoose。

mongoose 旧版本的文档写的不是很好，现在 v5 的[文档](https://mongoosejs.com/docs/guide.htm) 倒是写的还可以

- 理解 Schema 与 Model 的关系与相应 api
- 了解 middleware，运用 middleware，可以在修改之前对文档进行校验，也可以对查询结果进行一些格式化的操作。我之前没注意到这个，导致目前工程中有些重复的格式化的代码。
- 了解 plugin，同样可以在某些情况下减少重复工作量
