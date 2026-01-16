CREATE DATABASE coffeeShop;

USE coffeeShop;

CREATE TABLE
    Users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        user_name VARCHAR(100) NOT NULL,
        user_email VARCHAR(100) NOT NULL UNIQUE,
        user_password VARCHAR(100) NOT NULL,
        role VARCHAR(255) NOT NULL
    );

CREATE TABLE
    Categories (
        categories_id INT AUTO_INCREMENT PRIMARY KEY,
        categories_name VARCHAR(255) NOT NULL
    );

CREATE TABLE
    Drinks (
        drinks_id INT AUTO_INCREMENT PRIMARY KEY,
        drinks_image VARCHAR(255) NOT NULL,
        drinks_name VARCHAR(100) NOT NULL,
        drinks_price DECIMAL(5, 2) NOT NULL,
        drinks_temperature ENUM ('Hot', 'Cold') NOT NULL,
        drinks_description TEXT,
        categories_id INT,
        FOREIGN KEY (categories_id) REFERENCES Categories (categories_id)
    );

CREATE TABLE
    Orders (
        order_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        total_price DECIMAL(7, 2) NOT NULL,
        order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

CREATE TABLE
    OrderItems (
        order_item_id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT,
        drinks_id INT,
        price DECIMAL(5, 2) NOT NULL,
        quantity INT NOT NULL,
        FOREIGN KEY (order_id) REFERENCES Orders (order_id),
        FOREIGN KEY (drinks_id) REFERENCES Drinks (drinks_id)
    );

INSERT INTO
    Categories (categories_name)
VALUES
    ('Classic'),
    ('Coconut series'),
    ('Tea'),
    ('Chocolate series'),
    ('Frappe'),
    ('Top Picks');

INSERT INTO
    Drinks (
        drinks_image,
        drinks_name,
        drinks_price,
        drinks_temperature,
        drinks_description,
        categories_id
    )
VALUES
    -- 1. Classic
    (
        'Images/menu/americano.png',
        'Americano',
        6.90,
        'Hot',
        'Rich espresso with hot water',
        1
    ),
    (
        'Images/menu/no_preview.jpg',
        'Americano',
        7.90,
        'Cold',
        'Iced Americano',
        1
    ),
    (
        'Images/menu/latte.png',
        'Cafe Latte',
        8.90,
        'Hot',
        'Espresso with steamed milk',
        1
    ),
    (
        'Images/menu/no_preview.jpg',
        'Cafe Latte',
        9.90,
        'Cold',
        'Iced Cafe Latte',
        1
    ),
    (
        'Images/menu/mocha.png',
        'Mocha',
        9.90,
        'Hot',
        'Espresso with chocolate and milk',
        1
    ),
    (
        'Images/menu/no_preview.jpg',
        'Mocha',
        10.90,
        'Cold',
        'Iced Mocha',
        1
    ),
    (
        'Images/menu/cappucino.png',
        'Cappucino',
        8.90,
        'Hot',
        'Espresso topped with foamed milk',
        1
    ),
    (
        'Images/menu/icedCappucino.png',
        'Cappucino',
        9.90,
        'Cold',
        'Chilled cappuccino over ice',
        1
    ),
    (
        'Images/menu/spanish_latte.png',
        'Spanish Latte',
        10.90,
        'Hot',
        'Sweet latte with condensed milk',
        1
    ),
    (
        'Images/menu/no_preview.jpg',
        'Spanish Latte',
        11.90,
        'Cold',
        'Iced Spanish Latte',
        1
    ),
    (
        'Images/menu/espresso.png',
        'Espresso',
        4.90,
        'Hot',
        'Strong, concentrated coffee shot',
        1
    ), -- No Cold Option
    -- 2. Tea
    (
        'Images/menu/no_preview.jpg',
        'Green Tea Latte',
        9.90,
        'Hot',
        'Creamy matcha green tea',
        3
    ),
    (
        'Images/menu/green_tea_latte.png',
        'Green Tea Latte',
        10.90,
        'Cold',
        'Iced Green Tea Latte',
        3
    ),
    (
        'Images/menu/matcha_latte.png',
        'Matcha Latte',
        9.90,
        'Hot',
        'Premium Japanese matcha milk',
        3
    ),
    (
        'Images/menu/no_preview.jpg',
        'Matcha Latte',
        10.90,
        'Cold',
        'Iced Matcha Latte',
        3
    ),
    (
        'Images/menu/earl_grey_tea.jpg',
        'Earl Grey Tea',
        5.90,
        'Hot',
        'Black tea with bergamot oil',
        3
    ),
    (
        'Images/menu/no_preview.jpg',
        'Earl Grey Tea',
        6.90,
        'Cold',
        'Iced Earl Grey',
        3
    ),
    (
        'Images/menu/no_preview.jpg',
        'Lemon Tea',
        6.50,
        'Hot',
        'Warm lemon tea',
        3
    ),
    (
        'Images/menu/lemon_tea.png',
        'Lemon Tea',
        6.50,
        'Cold',
        'Iced tea with fresh lemon',
        3
    ),
    (
        'Images/menu/jasmine_tea.png',
        'Jasmine Tea',
        5.90,
        'Hot',
        'Fragrant floral tea',
        3
    ),
    (
        'Images/menu/no_preview.jpg',
        'Jasmine Tea',
        6.90,
        'Cold',
        'Iced Jasmine Tea',
        3
    ),
    -- 3. Chocolate Series
    (
        'Images/menu/no_preview.jpg',
        'Authentic Chocolate',
        9.90,
        'Hot',
        'Rich premium hot chocolate',
        4
    ),
    (
        'Images/menu/chocolate.png',
        'Authentic Chocolate',
        10.90,
        'Cold',
        'Iced Authentic Chocolate',
        4
    ),
    (
        'Images/menu/no_preview.jpg',
        'Chocolate Milk',
        6.90,
        'Hot',
        'Warm chocolate milk',
        4
    ),
    (
        'Images/menu/chocolate_milk.png',
        'Chocolate Milk',
        6.90,
        'Cold',
        'Chilled sweet chocolate milk',
        4
    ),
    (
        'Images/menu/no_preview.jpg',
        'Roasted Hazelnut Choco',
        10.90,
        'Hot',
        'Chocolate with roasted hazelnut',
        4
    ),
    (
        'Images/menu/hazelnut_chocolate.png',
        'Roasted Hazelnut Choco',
        11.90,
        'Cold',
        'Iced Hazelnut Chocolate',
        4
    ),
    -- 4. Frappe (No Hot Options)
    (
        'Images/menu/java_chip_chocolate.png',
        'JavaChip Chocolate',
        13.90,
        'Cold',
        'Ice blended coffee with choco chips',
        5
    ),
    (
        'Images/menu/green_tea_latte_frappe.png',
        'Green Tea Latte Frappe',
        13.90,
        'Cold',
        'Blended matcha green tea',
        5
    ),
    (
        'Images/menu/mango_frappe.png',
        'Mango Frappe',
        12.90,
        'Cold',
        'Tropical mango smoothie',
        5
    ),
    (
        'Images/menu/no_preview.jpg',
        'Peach Frappe',
        12.90,
        'Cold',
        'Sweet peach ice blend',
        5
    ),
    (
        'Images/menu/caramel_frappuccino.png',
        'Caramel Frappuccino',
        13.50,
        'Cold',
        'Coffee blended with caramel syrup',
        5
    ),
    -- 5. Coconut Series
    (
        'Images/menu/no_preview.jpg',
        'Coconut Latte',
        10.90,
        'Hot',
        'Latte with coconut infusion',
        2
    ),
    (
        'Images/menu/coconut_latte.jpg',
        'Coconut Latte',
        11.90,
        'Cold',
        'Iced Coconut Latte',
        2
    ),
    (
        'Images/menu/no_preview.jpg',
        'Coconut Spanish Latte',
        11.90,
        'Hot',
        'Sweet coconut coffee blend',
        2
    ),
    (
        'Images/menu/no_preview.jpg',
        'Coconut Spanish Latte',
        12.90,
        'Cold',
        'Iced Coconut Spanish Latte',
        2
    ),
    (
        'Images/menu/no_preview.jpg',
        'Coconut Chocolate Latte',
        11.90,
        'Hot',
        'Coconut meets rich chocolate',
        2
    ),
    (
        'Images/menu/coconut_chocolate_latte.jpg',
        'Coconut Chocolate Latte',
        12.90,
        'Cold',
        'Iced Coconut Chocolate Latte',
        2
    );