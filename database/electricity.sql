CREATE DATABASE IF NOT EXISTS smart_electricity;
USE smart_electricity;

CREATE TABLE IF NOT EXISTS bills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    consumer_id VARCHAR(50) NOT NULL UNIQUE,
    consumer_name VARCHAR(100) NOT NULL,
    meter_number VARCHAR(50) NOT NULL,
    consumer_type VARCHAR(50) NOT NULL,
    previous_reading DECIMAL(10,2) NOT NULL,
    current_reading DECIMAL(10,2) NOT NULL,
    units_consumed DECIMAL(10,2) NOT NULL,
    unit_rate DECIMAL(10,2) NOT NULL,
    bill_amount DECIMAL(10,2) NOT NULL,
    bill_date DATE NOT NULL,
    due_date DATE NOT NULL,
    payment_status ENUM('Paid','Pending') NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
