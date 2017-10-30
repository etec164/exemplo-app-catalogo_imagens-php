CREATE DATABASE catalogo_img;

USE catalogo_img;

CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha CHAR(64) NOT NULL,
    administrador BOOLEAN DEFAULT FALSE
);

INSERT INTO usuarios(id, email, senha, administrador) VALUES
    (1, 'admin@admin.com', SHA2('admin', 256), TRUE),
    (2, 'user@user.com', SHA2('user', 256), FALSE);

CREATE TABLE imagens(
    id INT AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(255) NOT NULL UNIQUE,
    id_usuario INT NOT NULL REFERENCES usuarios(id)
);

CREATE TABLE comentarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_imagem INT NOT NULL REFERENCES imagens(id),
    id_usuario INT NOT NULL REFERENCES usuarios(id),
    texto TEXT NOT NULL
);