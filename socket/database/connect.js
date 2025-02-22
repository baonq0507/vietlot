const mysql = require('mysql2');

const pool = mysql.createPool({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'vietlot',
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

