create table user_order
(
    user_id    int                                 not null,
    product_id int                                 not null,
    created_at timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user (Id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products (Id) ON DELETE CASCADE
);

INSERT INTO user_order (user_id, product_id, created_at) VALUES (1, 4, '2024-02-14 18:41:25');
INSERT INTO user_order (user_id, product_id, created_at) VALUES (2, 1, '2024-02-14 18:40:52');
INSERT INTO user_order (user_id, product_id, created_at) VALUES (2, 2, '2024-02-14 18:40:51');
INSERT INTO user_order (user_id, product_id, created_at) VALUES (2, 3, '2024-02-02 18:40:45');