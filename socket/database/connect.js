const mysql = require('mysql2');
require('dotenv').config();
const { DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE } = process.env;

const pool = mysql.createPool({
    host: DB_HOST,
    user: DB_USER,
    password: DB_PASSWORD,
    database: DB_DATABASE,
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0,
    enableKeepAlive: true,
    keepAliveInitialDelay: 0,
});

const connection = pool.promise();

//nếu connect thành công thì gọi hàm
connection.getConnection((err) => {
    if (err) {
        console.log('connect failed', err);
    } else {
        console.log('connect success');
    }
});
module.exports = connection;

