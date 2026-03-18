-- Additional module tables for the standalone Sash pages
USE legalvista;

CREATE TABLE IF NOT EXISTS listing_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    salary VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    job_title VARCHAR(150) NOT NULL,
    location VARCHAR(150) DEFAULT NULL,
    country VARCHAR(100) DEFAULT NULL,
    languages VARCHAR(255) DEFAULT NULL,
    email VARCHAR(150) DEFAULT NULL,
    phone VARCHAR(50) DEFAULT NULL,
    about TEXT,
    experience TEXT,
    company VARCHAR(150) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS dashboard_metrics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    metric_label VARCHAR(150) NOT NULL,
    metric_value VARCHAR(150) NOT NULL,
    trend_direction ENUM('up', 'down', 'flat') DEFAULT 'flat',
    trend_value VARCHAR(50) DEFAULT NULL,
    trend_period VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO listing_items (name, position, start_date, salary) VALUES
('Bella Chloe', 'System Developer', '2018-03-12', '$654,765'),
('Donna Bond', 'Account Manager', '2012-02-21', '$543,654'),
('Kyle Newton', 'Lead Designer', '2015-07-08', '$498,121');

INSERT INTO profiles (full_name, job_title, location, country, languages, email, phone, about, experience, company) VALUES
('Percy Kewshun', 'Web Developer', 'San Francisco, CA', 'USA', 'English, German, Spanish', 'georgeme@abc.com', '+125 254 3562', 'Very well thought out and articulate description of my professional background and expertise. I have over 10 years of experience in web development, specializing in front-end technologies and modern frameworks.', 'My passion lies in creating intuitive and visually stunning user interfaces that provide exceptional user experiences.', 'BetaSoft LLC');

INSERT INTO dashboard_metrics (metric_label, metric_value, trend_direction, trend_value, trend_period) VALUES
('Total Users', '44,278', 'up', '5%', 'Last week'),
('Total Profit', '$67,987', 'down', '0.75%', 'Last 6 days'),
('Total Expenses', '$76,965', 'up', '0.9%', 'Last 9 days'),
('Total Cost', '$59,765', 'up', '0.6%', 'Last year');
