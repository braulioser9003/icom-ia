-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-04-2017 a las 20:23:46
-- Versión del servidor: 5.7.11
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `icom_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE `autor` (
  `id` int(11) NOT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `Nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Apellidos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pertenece_institucion` tinyint(1) NOT NULL,
  `institucion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `tipoAutor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`id`, `pais_id`, `Nombre`, `Apellidos`, `correo`, `pertenece_institucion`, `institucion`, `estado`, `tipoAutor_id`) VALUES
(6, 55, 'Braulio', 'Rodriguez Aragones', 'braulio@fcom.uh.cu', 0, '-', 1, 1),
(8, 55, 'Liannet', 'Gomez Abraham', 'lgomez@fcom.uh.cu', 0, '-', 1, 1),
(13, 1, 'Daniel', 'De la Osa Camacho', 'dcamacho@fcom.uh.cu', 0, '-', 1, 1),
(14, 3, 'Rolando', 'Gimenes Sanchez', 'roly@prueba.com', 0, '-', 1, 1),
(17, 22, 'Lazaro', 'Gonzales Gimenes', 'lgomez@fcom.uh.cu', 0, '-', 1, 1),
(18, 4, 'Braulio', 'Gimenes Gimenes', 'bratttt@fcom.uh.cu', 0, '-', 1, 1),
(20, 55, 'Yanara', 'Dorado Santana', 'yanydorado@gmail.com', 1, 'Instituto Superior de Ciencias de la Comunicación (ISUCIC) . Angola', 1, 1),
(22, 1, 'sdsadas', 'sadsadas', 'sadsadsa@dsadsad.com', 0, '-', 1, 1),
(24, 55, 'assa', 'asas', 'asasa@dsdsd.com', 0, '-', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor_ponencias`
--

CREATE TABLE `autor_ponencias` (
  `ponencias_id` int(11) NOT NULL,
  `autor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `autor_ponencias`
--

INSERT INTO `autor_ponencias` (`ponencias_id`, `autor_id`) VALUES
(4, 6),
(4, 8),
(4, 13),
(5, 14),
(5, 18),
(8, 17),
(9, 20),
(11, 22),
(13, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `noticias_id` int(11) DEFAULT NULL,
  `asunto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comentario` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `document`
--

INSERT INTO `document` (`id`, `name`, `path`) VALUES
(1, '3.png', 'uploads/documents'),
(2, 'Mi niña.docx', 'uploads/documents');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `estado` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `estado`) VALUES
(1, 'Resumen en revisión'),
(2, 'Resumen aceptado'),
(3, 'Resumen no aceptado'),
(4, 'Ponencia en revisión'),
(5, 'Ponencia aceptada'),
(6, 'Ponencia no aceptada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE `etiqueta` (
  `id` int(11) NOT NULL,
  `etiqueta` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `etiqueta_id` int(11) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resumen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenido` longtext COLLATE utf8_unicode_ci NOT NULL,
  `publicado` tinyint(1) NOT NULL,
  `actualizado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `etiqueta_id`, `document_id`, `titulo`, `resumen`, `contenido`, `publicado`, `actualizado`) VALUES
(1, NULL, 1, 'sdas', 'asdsad', '<p>sadsadsa</p>', 1, '2017-04-06 15:33:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `pais` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `pais`) VALUES
(1, 'Afganistán'),
(2, 'Albania'),
(3, 'Alemania'),
(4, 'Andorra'),
(5, 'Angola'),
(6, 'Anguila'),
(7, 'Antártida'),
(8, 'Antigua y Barbuda'),
(9, 'Antillas Holandesas'),
(10, 'Arabia Saudí'),
(11, 'Argelia'),
(12, 'Argentina'),
(13, 'Armenia'),
(14, 'Aruba'),
(15, 'Australia'),
(16, 'Austria'),
(17, 'Azerbaiyán'),
(18, 'Bahamas'),
(19, 'Bahrein'),
(20, 'Bangladesh'),
(21, 'Barbados'),
(22, 'Bélgica'),
(23, 'Belice'),
(24, 'Benin'),
(25, 'Bermudas'),
(26, 'Bielorrusia'),
(27, 'Birmania'),
(28, 'Bolivia'),
(29, 'Bonaire, Sint Eustatius and Saba'),
(30, 'Bosnia Herzegovina'),
(31, 'Botsuana'),
(32, 'Brasil'),
(33, 'Brunei'),
(34, 'Bulgaria'),
(35, 'Burkina Faso'),
(36, 'Burundi'),
(37, 'Bután'),
(38, 'Cabo Verde'),
(39, 'Camboya'),
(40, 'Camerún'),
(41, 'Canadá'),
(42, 'Chad'),
(43, 'Chile'),
(44, 'China'),
(45, 'Chipre'),
(46, 'Colombia'),
(47, 'Comoras'),
(48, 'Congo (Brazzaville)'),
(49, 'Congo (Kinshasa)'),
(50, 'Corea del Norte'),
(51, 'Corea del Sur'),
(52, 'Costa de Marfil'),
(53, 'Costa Rica'),
(54, 'Croacia'),
(55, 'Cuba'),
(56, 'Curazao'),
(57, 'Dinamarca'),
(58, 'Dominica'),
(59, 'Ecuador'),
(60, 'Egipto'),
(61, 'El Salvador'),
(62, 'El Vaticano'),
(63, 'Emiratos Árabes Unidos'),
(64, 'Eritrea'),
(65, 'Eslovaquia'),
(66, 'Eslovenia'),
(67, 'España'),
(68, 'Estados Unidos'),
(69, 'Estonia'),
(70, 'Etiopía'),
(71, 'Filipinas'),
(72, 'Finlandia'),
(73, 'Fiyi'),
(74, 'Francia'),
(75, 'Gabón'),
(76, 'Gambia'),
(77, 'Georgia'),
(78, 'Ghana'),
(79, 'Gibraltar'),
(80, 'Granada'),
(81, 'Grecia'),
(82, 'Groenlandia'),
(83, 'Guadalupe'),
(84, 'Guam'),
(85, 'Guatemala'),
(86, 'Guayana'),
(87, 'Guayana Francesa'),
(88, 'Guernsey'),
(89, 'Guinea'),
(90, 'Guinea-Bissau'),
(91, 'Guinea Ecuatorial'),
(92, 'Haití'),
(93, 'Honduras'),
(94, 'Hungría'),
(95, 'Indonesia'),
(96, 'Irak'),
(97, 'Irán'),
(98, 'Irlanda'),
(99, 'Isla Bouvet'),
(100, 'Isla de Man'),
(101, 'Isla de Navidad'),
(102, 'Isla de Norfolk'),
(103, 'Islandia'),
(104, 'Islas Aland'),
(105, 'Islas Caimán'),
(106, 'Islas Cocos'),
(107, 'Islas Cook'),
(108, 'Islas Feroe'),
(109, 'Islas Georgias del Sur y Sandwich del Sur'),
(110, 'Islas Heard y McDonald'),
(111, 'Islas Malvinas/Falkland'),
(112, 'Islas Marianas del Norte'),
(113, 'Islas Marshall'),
(114, 'Islas Salomón'),
(115, 'Islas Turcas y Caicos'),
(116, 'Islas Ultramarinas de Estados Unidos'),
(117, 'Islas Vírgenes Británicas'),
(118, 'Islas Vírgenes de los Estados Unidos'),
(119, 'Israel'),
(120, 'Italia'),
(121, 'Jamaica'),
(122, 'Japón'),
(123, 'Jersey'),
(124, 'Jordania'),
(125, 'Kazajastán'),
(126, 'Kenia'),
(127, 'Kirguistán'),
(128, 'Kiribati'),
(129, 'Kuwait'),
(130, 'La India'),
(131, 'Laos'),
(132, 'Lesotho'),
(133, 'Letonia'),
(134, 'Líbano'),
(135, 'Liberia'),
(136, 'Libia'),
(137, 'Liechtenstein'),
(138, 'Lituania'),
(139, 'Luxemburgo'),
(140, 'Macedonia'),
(141, 'Madagascar'),
(142, 'Malasia'),
(143, 'Malaui'),
(144, 'Maldivas'),
(145, 'Mali'),
(146, 'Malta'),
(147, 'Marruecos'),
(148, 'Martinica'),
(149, 'Mauricio'),
(150, 'Mauritania'),
(151, 'Mayotte'),
(152, 'México'),
(153, 'Micronesia'),
(154, 'Moldavia'),
(155, 'Mónaco'),
(156, 'Mongolia'),
(157, 'Montenegro'),
(158, 'Montserrat'),
(159, 'Mozambique'),
(160, 'Namibia'),
(161, 'Nauru'),
(162, 'Nepal'),
(163, 'Nicaragua'),
(164, 'Níger'),
(165, 'Nigeria'),
(166, 'Niue'),
(167, 'Noruega'),
(168, 'Nueva Caledonia'),
(169, 'Nueva Zelanda'),
(170, 'Omán'),
(171, 'Países Bajos'),
(172, 'Palau'),
(173, 'Panamá'),
(174, 'Papúa Nueva Guinea'),
(175, 'Paraguay'),
(176, 'Perú'),
(177, 'Pitcairn'),
(178, 'Polinesia Francesa'),
(179, 'Polonia'),
(180, 'Portugal'),
(181, 'Puerto Rico'),
(182, 'Qatar'),
(183, 'R.A.E. de Hong Kong, China'),
(184, 'R.A.E. de Macao, China'),
(185, 'Reino Unido'),
(186, 'República Centroafricana'),
(187, 'República Checa'),
(188, 'República Dominicana'),
(189, 'Reunión'),
(190, 'Ruanda'),
(191, 'Rumanía'),
(192, 'Rusia'),
(193, 'Sáhara Occidental'),
(194, 'Samoa'),
(195, 'Samoa americana'),
(196, 'San Bartolomé'),
(197, 'San Cristóbal y Nieves'),
(198, 'San Marino'),
(199, 'San Martín (parte francesa)'),
(200, 'San Pedro y Miguelón'),
(201, 'Santa Helena'),
(202, 'Santa Lucía'),
(203, 'Santo Tomé y Príncipe'),
(204, 'San Vicente y las Granadinas'),
(205, 'Senegal'),
(206, 'Serbia'),
(207, 'Seychelles'),
(208, 'Sierra Leona'),
(209, 'Singapur'),
(210, 'Sint Maarten (Dutch part)'),
(211, 'Siria'),
(212, 'Somalia'),
(213, 'South Sudan'),
(214, 'Sri Lanka'),
(215, 'Suazilandia'),
(216, 'Sudáfrica'),
(217, 'Sudán'),
(218, 'Suecia'),
(219, 'Suiza'),
(220, 'Surinam'),
(221, 'Svalbard y Jan Mayen'),
(222, 'Tailandia'),
(223, 'Taiwán'),
(224, 'Tanzania'),
(225, 'Tayikistán'),
(226, 'Territorio Británico del Océano Índico'),
(227, 'Territorio Palestino'),
(228, 'Territorios Australes Franceses'),
(229, 'Timor Oriental'),
(230, 'Togo'),
(231, 'Tokelau'),
(232, 'Tonga'),
(233, 'Trinidad y Tobago'),
(234, 'Túnez'),
(235, 'Turkmenistán'),
(236, 'Turquía'),
(237, 'Tuvalu'),
(238, 'Ucrania'),
(239, 'Uganda'),
(240, 'Uruguay'),
(241, 'Uzbekistán'),
(242, 'Vanuatu'),
(243, 'Venezuela'),
(244, 'Vietnam'),
(245, 'Wallis y Futuna'),
(246, 'Yemen'),
(247, 'Yibuti'),
(248, 'Zambia'),
(249, 'Zimbabue');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabra_clave`
--

CREATE TABLE `palabra_clave` (
  `id` int(11) NOT NULL,
  `ponencias_id` int(11) DEFAULT NULL,
  `palabraClave` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `palabra_clave`
--

INSERT INTO `palabra_clave` (`id`, `ponencias_id`, `palabraClave`) VALUES
(1, NULL, 'asdsadsa'),
(2, NULL, 'asdsadas'),
(3, NULL, 'asdsadas'),
(4, NULL, 'asdasd'),
(5, NULL, 'asdasd'),
(6, NULL, 'sads'),
(7, NULL, 'sadsa'),
(8, NULL, 'asdfsaf'),
(9, NULL, 'safsaf'),
(10, NULL, 'sadasd'),
(11, NULL, 'sadasd'),
(12, NULL, 'sadas'),
(13, NULL, 'sadsa'),
(14, NULL, 'sadsa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ponencias`
--

CREATE TABLE `ponencias` (
  `id` int(11) NOT NULL,
  `tematica_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `Titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resumen` longtext COLLATE utf8_unicode_ci NOT NULL,
  `actualizado` datetime NOT NULL,
  `document_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ponencias`
--

INSERT INTO `ponencias` (`id`, `tematica_id`, `estado_id`, `Titulo`, `resumen`, `actualizado`, `document_id`) VALUES
(2, 1, 1, 'asdas', 'asdasdas', '2017-04-08 20:00:13', NULL),
(3, 2, 1, 'sdas', 'sadasdas', '2017-04-09 17:37:48', NULL),
(4, 2, 1, 'sdfasdf', 'sadsadas', '2017-04-11 03:27:18', NULL),
(5, 2, 1, 'dsfsrrrr', 'safsafas', '2017-04-11 21:25:52', NULL),
(6, 2, 2, 'dsfsfd', 'safsafas', '2017-04-11 21:31:00', NULL),
(7, 2, 1, 'dsfsfd', 'safsafas', '2017-04-11 21:32:19', NULL),
(8, 2, 1, 'dsfsfd', 'safsafas', '2017-04-11 21:33:54', NULL),
(9, 4, 1, 'El curso de Licenciatura en Ciencias de la Información  en Angola: una experiencia pedagógica y científica en colaboración y movilidad internacional con la República de Cuba.', 'Se presenta una experiencia pedagógica - científica en el campo disciplinar de las Ciencias de la Información en la República de Angola, a partir de la implementación del Proyecto Pedagógico y Científico, específicamente en el Instituto Superior de Ciencias de la Comunicación (ISUCIC) en la ciudad de Kilamba, Luanda. El trabajo tiene la finalidad de mostrar un conjunto de acciones prácticas realizadas por profesionales docentes y estudiantes de la carrera, desde sus inicios hasta la actualidad como fruto de la colaboración y movilidad entre Cuba - Angola. La investigación que se presenta busca no solo analizar y compartir experiencias del trabajo realizado durante estos primeros 4 años de formación académica en Angola, sino potenciar la reflexión , estimular la innovación e incentivar a estudiantes y profesores para que en los próximos años hagan mas y mejor por el futuro de las Ciencias de la Información en Angola. Entre los métodos aplicados para el desarrollo de la investigación se encuentran la observación directa e indirecta, entrevistas y encuestas que permitieron evaluar los resultados que se ofrecen.', '2017-04-12 14:36:35', NULL),
(11, 5, 2, 'sdasdsa', 'sadsadas', '2017-04-12 17:44:57', 2),
(13, 9, 2, 'sadsad', 'sadsadas', '2017-04-12 18:05:54', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tematica`
--

CREATE TABLE `tematica` (
  `id` int(11) NOT NULL,
  `tematica` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tematica`
--

INSERT INTO `tematica` (`id`, `tematica`) VALUES
(1, 'EJE 1: Formación y desarrollo profesional en pre y postgrado'),
(2, '-1.1 Programas de estudio, competencias profesionales y transdisciplinariedad en información, periodismo y comunicación social. Correspondencia con las demandas del mercado laboral'),
(3, '-1.2 Retos y oportunidades del desarrollo de las TICs para la formación y el aprendizaje profesional'),
(4, '-1.3 Docencia, investigación, extensión, colaboración y movilidad en la formación académica y profesional'),
(5, '-1.4 Desarrollo local y aprendizaje en la información y la comunicación'),
(6, 'EJE 2: Entornos laborales en los campos de la información, el periodismo y la comunicación'),
(7, '-2.1  Entornos laborales y retos socioculturales en el mundo contemporáneo:  tecnologías, desterritorialización, espacios locales, políticas  públicas, ética, medios y política y arte social'),
(8, '-2.2  Nuevas formas de acción e interacción entre la información y la  comunicación. Experiencias en los entornos laborales  infocomunicacionales'),
(9, '-2.3 Gestión de la información, la comunicación y el conocimiento en los entornos laborales. Experiencias'),
(10, '-2.4  Escenarios profesionales especializados: medio ambiente, prevención de  riesgos y situaciones de desastre, conflictos, demografía, salud,  juventud, inclusión social, turismo, arte y cultura, deporte y  administración pública'),
(11, 'EJE 3: Gestión de la investigación'),
(12, '-3.1 Estado del conocimiento y agendas investigativas en los campos de la información y la comunicación'),
(13, '-3.2 Fundamentos teóricos y metodológicos de la transdisciplinariedad para el estudio de lo infocomunicacional'),
(14, '-3.3 Visibilidad del conocimiento en el campo de la información y la comunicación'),
(15, '-3.4 Políticas e institucionalización de la investigación infocomunicacional. Proyectos y redes'),
(16, 'EJE 4: TICs y sociedad de la información'),
(17, '-4.1 Acceso y uso de las TICs para el desarrollo. Ecología de la información y de la comunicación'),
(18, '-4.2 Experiencias e impacto del mundo “open”: open science, open data'),
(19, '-4.3 Comunicación visual e interactiva en la información, el periodismo y la comunicación'),
(20, '-4.4 Comunicación alternativa, comunidades y movimientos sociales en los entornos digitales'),
(21, '-4.5 Gobierno electrónico y sociedad de la información');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_autor`
--

CREATE TABLE `tipo_autor` (
  `id` int(11) NOT NULL,
  `tipoAutor` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_autor`
--

INSERT INTO `tipo_autor` (`id`, `tipoAutor`) VALUES
(1, 'Principal'),
(2, 'Coautor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_31075EBAC604D5C6` (`pais_id`),
  ADD KEY `IDX_31075EBA8A13F935` (`tipoAutor_id`);

--
-- Indices de la tabla `autor_ponencias`
--
ALTER TABLE `autor_ponencias`
  ADD PRIMARY KEY (`ponencias_id`,`autor_id`),
  ADD KEY `IDX_BA550C551752283` (`ponencias_id`),
  ADD KEY `IDX_BA550C514D45BBE` (`autor_id`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4B91E702FA5F3F21` (`noticias_id`);

--
-- Indices de la tabla `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_253D925C33F7837` (`document_id`),
  ADD KEY `IDX_253D925D53DA3AB` (`etiqueta_id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `palabra_clave`
--
ALTER TABLE `palabra_clave`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8CAF1CFA51752283` (`ponencias_id`);

--
-- Indices de la tabla `ponencias`
--
ALTER TABLE `ponencias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_61ACD733C33F7837` (`document_id`),
  ADD KEY `IDX_61ACD733500BB20C` (`tematica_id`),
  ADD KEY `IDX_61ACD7339F5A440B` (`estado_id`);

--
-- Indices de la tabla `tematica`
--
ALTER TABLE `tematica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_autor`
--
ALTER TABLE `tipo_autor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autor`
--
ALTER TABLE `autor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;
--
-- AUTO_INCREMENT de la tabla `palabra_clave`
--
ALTER TABLE `palabra_clave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `ponencias`
--
ALTER TABLE `ponencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `tematica`
--
ALTER TABLE `tematica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `tipo_autor`
--
ALTER TABLE `tipo_autor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autor`
--
ALTER TABLE `autor`
  ADD CONSTRAINT `FK_31075EBA8A13F935` FOREIGN KEY (`tipoAutor_id`) REFERENCES `tipo_autor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_31075EBAC604D5C6` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `autor_ponencias`
--
ALTER TABLE `autor_ponencias`
  ADD CONSTRAINT `FK_BA550C514D45BBE` FOREIGN KEY (`autor_id`) REFERENCES `autor` (`id`),
  ADD CONSTRAINT `FK_BA550C551752283` FOREIGN KEY (`ponencias_id`) REFERENCES `ponencias` (`id`);

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `FK_4B91E702FA5F3F21` FOREIGN KEY (`noticias_id`) REFERENCES `noticias` (`id`);

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `FK_253D925C33F7837` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_253D925D53DA3AB` FOREIGN KEY (`etiqueta_id`) REFERENCES `etiqueta` (`id`);

--
-- Filtros para la tabla `palabra_clave`
--
ALTER TABLE `palabra_clave`
  ADD CONSTRAINT `FK_8CAF1CFA51752283` FOREIGN KEY (`ponencias_id`) REFERENCES `ponencias` (`id`);

--
-- Filtros para la tabla `ponencias`
--
ALTER TABLE `ponencias`
  ADD CONSTRAINT `FK_61ACD733500BB20C` FOREIGN KEY (`tematica_id`) REFERENCES `tematica` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_61ACD7339F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_61ACD733C33F7837` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
