CREATE TABLE contact_enquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    service VARCHAR(150),
    message TEXT,
    status VARCHAR(50) NOT NULL DEFAULT 'New',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
