CREATE TABLE individual_images (
  image_id INT AUTO_INCREMENT PRIMARY KEY,
  image_name VARCHAR(100) NOT NULL,
  category VARCHAR(255) NOT NULL

);
CREATE TABLE combination_images (
  combination_id INT AUTO_INCREMENT PRIMARY KEY,
  combination_name VARCHAR(100) NOT NULL,
  num_individual_images INT NOT NULL
);
CREATE TABLE image_combinations (
  combination_id INT NOT NULL,
  image_id INT NOT NULL,
  FOREIGN KEY (combination_id) REFERENCES combination_images(combination_id),
  FOREIGN KEY (image_id) REFERENCES individual_images(image_id)
);

-- CREATE TABLE user_generated_combinations (
--   combination_id INT AUTO_INCREMENT PRIMARY KEY,
--   -- user_id INT NOT NULL, -- Assuming you have user authentication
--   individual_image_ids VARCHAR(255) NOT NULL,
--   combined_image_path VARCHAR(255) NOT NULL,
--   timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

