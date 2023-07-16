DROP DATABASE IF EXISTS futbol2023;

CREATE DATABASE futbol2023;

USE futbol2023;

CREATE TABLE `alquileres` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `idSocio` INT(11) DEFAULT NULL,
  `idCampo` INT(11) DEFAULT NULL,
  `fechaHora` DATETIME NOT NULL,
  `horas` INT(11) DEFAULT NULL,
  `personas` INT(11) DEFAULT NULL,
  `precioTotal` FLOAT DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO
  `alquileres` (
    `id`,
    `idSocio`,
    `idCampo`,
    `fechaHora`,
    `horas`,
    `personas`,
    `precioTotal`
  )
VALUES
  (1, 1, 1, '2023-01-01 10:00:00', 2, 10, 240),
  (2, 2, 2, '2023-01-02 15:00:00', 1, 5, 120),
  (3, 1, 3, '2023-01-03 14:00:00', 2, 8, 240);

CREATE TABLE `campos` (
  `id` INT(11) NOT NULL,
  `nombre` VARCHAR(300) DEFAULT NULL,
  `aforo` INT(11) DEFAULT NULL,
  `precio` FLOAT DEFAULT NULL,
  `direccion` VARCHAR(400) DEFAULT NULL,
  `telefono` VARCHAR(20) DEFAULT NULL,
  `tipo` VARCHAR(200) DEFAULT NULL,
  `foto` VARCHAR(255) DEFAULT NULL,
  `rate` float(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO
  `campos` (
    `id`,
    `nombre`,
    `aforo`,
    `precio`,
    `direccion`,
    `telefono`,
    `tipo`,
    `foto`
  )
VALUES
  (
    1,
    'Santiago',
    22,
    120,
    'Madrid',
    '6546543215',
    'artificial',
    '1santiago.jpeg'
  ),
  (
    2,
    'Camp Neo',
    22,
    120,
    'Barcelona',
    '6546543215',
    'artificial',
    '2camonou.jpg'
  ),
  (
    3,
    'Stamford',
    22,
    120,
    'London',
    '6546543215',
    'artificial',
    '3stamford.webp'
  );

CREATE TABLE `socios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) DEFAULT NULL,
  `apellidos` VARCHAR(400) DEFAULT NULL,
  `email` VARCHAR(200) DEFAULT NULL,
  `telefono` VARCHAR(20) DEFAULT NULL,
  `fechahora` DATETIME NOT NULL,
  `password` VARCHAR(100) DEFAULT NULL,
  `isAdmin` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO
  `socios` (
    `id`,
    `nombre`,
    `apellidos`,
    `email`,
    `telefono`,
    `fechahora`,
    `password`,
    `isAdmin`
  )
VALUES
  (
    1,
    'John',
    'Doe',
    'john.doe@example.com',
    '1234567890',
    '2023-01-01 10:00:00',
    'password1',
    0
  ),
  (
    2,
    'Jane',
    'Smith',
    'jane.smith@example.com',
    '9876543210',
    '2023-01-02 12:00:00',
    'password2',
    0
  ),
  (
    3,
    'nabil',
    'badawi',
    'admin@example.com',
    '5555555555',
    '2023-01-01 00:00:00',
    '123456',
    1
  );

CREATE TABLE `comments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `comment` VARCHAR(500) NOT NULL,
  `userId` INT(11) NOT NULL,
  `postId` INT(11) NOT NULL,
  `timestamp` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE `replies` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `replyText` VARCHAR(500) NOT NULL,
  `userId` INT(11) NOT NULL,
  `commentId` INT(11) NOT NULL,
  `parentCommentId` INT(11),
  `parentReplyId` INT(11),
  `timestamp` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE `likes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `userId` INT(11) NOT NULL,
  `commentId` INT(11),
  `replyId` INT(11),
  `timestamp` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE `rates` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `idCampo` INT(11) NOT NULL,
  `userId` INT(11) NOT NULL,
  `rate` INT(11) NOT NULL,
  `comment` VARCHAR(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO
  `rates` (`idCampo`, `userId`, `rate`, `comment`)
VALUES
  (1, 1, 4, 'Great field!'),
  (2, 2, 3, 'Decent place to play.'),
  (3, 1, 5, 'Highly recommended.');

INSERT INTO
  `rates` (`idCampo`, `userId`, `rate`, `comment`)
VALUES
  (1, 2, 2, 'Needs improvement.');

-- Add foreign key constraints
ALTER TABLE
  `alquileres`
ADD
  CONSTRAINT `fkAlquileresSocios` FOREIGN KEY (`idSocio`) REFERENCES `socios` (`id`);

ALTER TABLE
  `alquileres`
ADD
  CONSTRAINT `fkAlquileresCampos` FOREIGN KEY (`idCampo`) REFERENCES `campos` (`id`);

ALTER TABLE
  `comments`
ADD
  CONSTRAINT `fkCommentsSocios` FOREIGN KEY (`userId`) REFERENCES `socios` (`id`);

ALTER TABLE
  `comments`
ADD
  CONSTRAINT `fkCommentsCampos` FOREIGN KEY (`postId`) REFERENCES `campos` (`id`);

ALTER TABLE
  `replies`
ADD
  CONSTRAINT `fkRepliesSocios` FOREIGN KEY (`userId`) REFERENCES `socios` (`id`);

ALTER TABLE
  `replies`
ADD
  CONSTRAINT `fkRepliesComments` FOREIGN KEY (`commentId`) REFERENCES `comments` (`id`);

ALTER TABLE
  `replies`
ADD
  CONSTRAINT `fkRepliesParentComments` FOREIGN KEY (`parentCommentId`) REFERENCES `comments` (`id`);

ALTER TABLE
  `replies`
ADD
  CONSTRAINT `fkRepliesParentReplies` FOREIGN KEY (`parentReplyId`) REFERENCES `replies` (`id`);

ALTER TABLE
  `likes`
ADD
  CONSTRAINT `fkLikesSocios` FOREIGN KEY (`userId`) REFERENCES `socios` (`id`);

ALTER TABLE
  `likes`
ADD
  CONSTRAINT `fkLikesComments` FOREIGN KEY (`commentId`) REFERENCES `comments` (`id`);

ALTER TABLE
  `likes`
ADD
  CONSTRAINT `fkLikesReplies` FOREIGN KEY (`replyId`) REFERENCES `replies` (`id`);

ALTER TABLE
  `rates`
ADD
  CONSTRAINT `fkRatesCampos` FOREIGN KEY (`idCampo`) REFERENCES `campos` (`id`);

ALTER TABLE
  `rates`
ADD
  CONSTRAINT `fkRatesSocios` FOREIGN KEY (`userId`) REFERENCES `socios` (`id`);