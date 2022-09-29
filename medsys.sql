-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2022 a las 01:22:48
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `medsys`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas`
--

CREATE TABLE `fichas` (
  `id_ficha` int(9) NOT NULL,
  `id_mascota` int(4) NOT NULL,
  `mascota` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `maniobra` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estudios_complementarios` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `diagnóstico` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tratamiento` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `indicaciones` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `fichas`
--

INSERT INTO `fichas` (`id_ficha`, `id_mascota`, `mascota`, `fecha`, `maniobra`, `descripcion`, `estudios_complementarios`, `diagnóstico`, `tratamiento`, `indicaciones`) VALUES
(1, 3, 'Gato', '2022-05-18', NULL, 'Descripción', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `id_mascota` int(4) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `especie` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `raza` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `peso` float DEFAULT NULL,
  `etapa` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dueño` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `id_dueño` int(8) DEFAULT NULL,
  `ultima_visita` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`id_mascota`, `nombre`, `especie`, `sexo`, `raza`, `peso`, `etapa`, `dueño`, `id_dueño`, `ultima_visita`) VALUES
(1, 'Yacko', 'Perro', 'Macho', NULL, NULL, NULL, 'Diego Pezet', 45031729, NULL),
(2, 'Fabri', 'Gato', 'Macho', NULL, NULL, NULL, 'Brisa de la Cerda', 45297893, NULL),
(3, 'Gato', 'Gato', 'Macho', 'miau miau', 5, 'Adulto', 'Diego Pezet', 45031729, NULL),
(10, 'SamplePet', 'Perro', 'Macho', 'Akita', 25, 'Adulto', 'Random User', 999, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razas_gatos`
--

CREATE TABLE `razas_gatos` (
  `raza` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `razas_gatos`
--

INSERT INTO `razas_gatos` (`raza`) VALUES
('Abisinio'),
('Abisinio'),
('American Shorthair'),
('American Shorthair'),
('American Wirehair'),
('American Wirehair'),
('Angora turco'),
('Angora turco'),
('Azul ruso'),
('Azul ruso'),
('Balinés'),
('Balinés'),
('Bengala'),
('Bengala'),
('Birmano'),
('Birmano'),
('Bobtail Americano'),
('Bobtail Americano'),
('Bobtail japonés'),
('Bobtail japonés'),
('Bombay'),
('Bombay'),
('Bosque de Noruega'),
('Bosque de Noruega'),
('British Longhair'),
('British Longhair'),
('British Shorthair'),
('British Shorthair'),
('Burmilla'),
('Burmilla'),
('California Spangled'),
('California Spangled'),
('California Spangled'),
('California Spangled'),
('Californian Rex'),
('Californian Rex'),
('Cartujo'),
('Cartujo'),
('Ceilán'),
('Ceilán'),
('Chausie'),
('Chausie'),
('Cornish Rex'),
('Cornish Rex'),
('Curl americano'),
('Curl americano'),
('Cymric'),
('Cymric'),
('Devon Rex'),
('Devon Rex'),
('Don Sphynx'),
('Don Sphynx'),
('Exótico'),
('Exótico'),
('Gato común'),
('Gato común'),
('Gato común europeo'),
('Gato común europeo'),
('Gato esfinge'),
('Gato esfinge'),
('Gato Siberiano'),
('Gato Siberiano'),
('Gato Van turco'),
('Gato Van turco'),
('German Rex'),
('German Rex'),
('Habana Brown'),
('Habana Brown'),
('Highland Fold y Highland Straight'),
('Highland Fold y Highland Straight'),
('Himalayo'),
('Himalayo'),
('Javanés'),
('Javanés'),
('Khao Manee'),
('Khao Manee'),
('Korat'),
('Korat'),
('LaPerm'),
('LaPerm'),
('Maine Coon'),
('Maine Coon'),
('Manx'),
('Manx'),
('Mau egipcio'),
('Mau egipcio'),
('Munchkin'),
('Munchkin'),
('Nebelung'),
('Nebelung'),
('Ocicat'),
('Ocicat'),
('Oriental'),
('Oriental'),
('Persa'),
('Persa'),
('Persa Chinchilla'),
('Persa Chinchilla'),
('Peterbald'),
('Peterbald'),
('Pixie Bob'),
('Pixie Bob'),
('Ragamuffin'),
('Ragamuffin'),
('Ragdoll'),
('Ragdoll'),
('Safari'),
('Safari'),
('Sagrado de Birmania'),
('Sagrado de Birmania'),
('Savannah'),
('Savannah'),
('Scottish Fold'),
('Scottish Fold'),
('Selkirk Rex'),
('Selkirk Rex'),
('Siamés'),
('Siamés'),
('Siamés thai'),
('Siamés thai'),
('Singapura'),
('Singapura'),
('Snowshoe'),
('Snowshoe'),
('Sokoke'),
('Sokoke'),
('Somalí'),
('Somalí'),
('Tiffany'),
('Tiffany'),
('Tonkinés'),
('Tonkinés'),
('Toyger'),
('Toyger'),
('York Chocolate'),
('York Chocolate');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razas_perros`
--

CREATE TABLE `razas_perros` (
  `raza` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `razas_perros`
--

INSERT INTO `razas_perros` (`raza`) VALUES
('Affenpinscher'),
('Airedale terrier'),
('Akita'),
('Akita americano'),
('Alaskan Husky'),
('Alaskan malamute'),
('American Foxhound'),
('American pit bull terrier'),
('American staffordshire terrier'),
('Ariegeois'),
('Artois'),
('Australian silky terrier'),
('Australian Terrier'),
('Austrian Black & Tan Hound'),
('Azawakh'),
('Balkan Hound'),
('Basenji'),
('Basset Alpino (Alpine Dachsbracke)'),
('Basset Artesiano Normando'),
('Basset Azul de Gascuña (Basset Bleu de Gascogne)'),
('Basset de Artois'),
('Basset de Westphalie'),
('Basset Hound'),
('Basset Leonado de Bretaña (Basset fauve de Bretagne)'),
('Bavarian Mountain Scenthound'),
('Beagle'),
('Beagle Harrier'),
('Beauceron'),
('Bedlington Terrier'),
('Bichon Boloñes'),
('Bichón Frisé'),
('Bichón Habanero'),
('Billy'),
('Black and Tan Coonhound'),
('Bloodhound (Sabueso de San Huberto)'),
('Bobtail'),
('Boerboel'),
('Border Collie'),
('Border terrier'),
('Borzoi'),
('Bosnian Hound'),
('Boston terrier'),
('Bouvier des Flandres'),
('Boxer'),
('Boyero de Appenzell'),
('Boyero de Australia'),
('Boyero de Entlebuch'),
('Boyero de las Ardenas'),
('Boyero de Montaña Bernes'),
('Braco Alemán de pelo corto'),
('Braco Alemán de pelo duro'),
('Braco de Ariege'),
('Braco de Auvernia'),
('Braco de Bourbonnais'),
('Braco de Saint Germain'),
('Braco Dupuy'),
('Braco Francés'),
('Braco Italiano'),
('Broholmer'),
('Buhund Noruego'),
('Bull terrier'),
('Bulldog americano'),
('Bulldog inglés'),
('Bulldog francés'),
('Bullmastiff'),
('Ca de Bestiar'),
('Cairn terrier'),
('Cane Corso'),
('Cane da Pastore Maremmano-Abruzzese'),
('Caniche (Poodle)'),
('Caniche Toy (Toy Poodle)'),
('Cao da Serra de Aires'),
('Cao da Serra de Estrela'),
('Cao de Castro Laboreiro'),
('Cao de Fila de Sao Miguel'),
('Cavalier King Charles Spaniel'),
('Cesky Fousek'),
('Cesky Terrier'),
('Chesapeake Bay Retriever'),
('Chihuahua'),
('Chin'),
('Chow Chow'),
('Cirneco del Etna'),
('Clumber Spaniel'),
('Cocker Spaniel Americano'),
('Cocker Spaniel Inglés'),
('Collie Barbudo'),
('Collie de Pelo Cort'),
('Collie de Pelo Largo'),
('Cotón de Tuléar'),
('Curly Coated Retriever'),
('Dálmata'),
('Dandie dinmont terrier'),
('Deerhound'),
('Dobermann'),
('Dogo Argentino'),
('Dogo de Burdeos'),
('Dogo del Tibet'),
('Drentse Partridge Dog'),
('Drever'),
('Dunker'),
('Elkhound Noruego'),
('Elkhound Sueco'),
('English Foxhound'),
('English Springer Spaniel'),
('English Toy Terrier'),
('Epagneul Picard'),
('Eurasier'),
('Fila Brasileiro'),
('Finnish Lapphound'),
('Flat Coated Retriever'),
('Fox terrier de pelo de alambre'),
('Fox terrier de pelo liso'),
('Foxhound Inglés'),
('Frisian Pointer'),
('Galgo Español'),
('Galgo húngaro (Magyar Agar)'),
('Galgo Italiano'),
('Galgo Polaco (Chart Polski)'),
('Glen of Imaal Terrier'),
('Golden Retriever'),
('Gordon Setter'),
('Gos d´Atura Catalá'),
('Gran Basset Griffon Vendeano'),
('Gran Boyero Suizo'),
('Gran Danés (Dogo Aleman)'),
('Gran Gascón Saintongeois'),
('Gran Griffon Vendeano'),
('Gran Munsterlander'),
('Gran Perro Japonés'),
('Grand Anglo Francais Tricoleur'),
('Grand Bleu de Gascogne'),
('Greyhound'),
('Griffon Bleu de Gascogne'),
('Griffon de pelo duro (Grifón Korthals)'),
('Griffon leonado de Bretaña'),
('Griffon Nivernais'),
('Grifon Belga'),
('Grifón de Bruselas'),
('Haldenstoever'),
('Harrier'),
('Hokkaido'),
('Hovawart'),
('Husky Siberiano (Siberian Husky)'),
('Ioujnorousskaia Ovtcharka'),
('Irish Glen of Imaal terrier'),
('Irish soft coated wheaten terrier'),
('Irish terrier'),
('Irish Water Spaniel'),
('Irish Wolfhound'),
('Jack Russell terrier'),
('Jindo Coreano'),
('Kai'),
('Keeshond'),
('Kelpie australiano (Australian kelpie)'),
('Kerry blue terrier'),
('King Charles Spaniel'),
('Kishu'),
('Komondor'),
('Kooiker'),
('Kromfohrländer'),
('Kuvasz'),
('Labrador Retriever'),
('Lagotto Romagnolo'),
('Laika de Siberia Occidental'),
('Laika de Siberia Oriental'),
('Laika Ruso Europeo'),
('Lakeland terrier'),
('Landseer'),
('Lapphund Sueco'),
('Lebrel Afgano'),
('Lebrel Arabe (Sloughi)'),
('Leonberger'),
('Lhasa Apso'),
('Lowchen (Pequeño Perro León)'),
('Lundehund Noruego'),
('Malamute de Alaska'),
('Maltés'),
('Manchester terrier'),
('Mastiff'),
('Mastín de los Pirineos'),
('Mastín Español'),
('Mastín Napolitano'),
('Mudi'),
('Norfolk terrier'),
('Norwich terrier'),
('Nova Scotia duck tolling retriever'),
('Ovejero alemán'),
('Otterhound'),
('Rafeiro do Alentejo'),
('Ratonero Bodeguero Andaluz'),
('Retriever de Nueva Escocia'),
('Rhodesian Ridgeback'),
('Ridgeback de Tailandia'),
('Rottweiler'),
('Saarloos'),
('Sabueso de Hamilton'),
('Sabueso de Hannover'),
('Sabueso de Hygen'),
('Sabueso de Istria'),
('Sabueso de Posavaz'),
('Sabueso de Schiller (Schillerstovare)'),
('Sabueso de Smaland (Smalandsstovare)'),
('Sabueso de Transilvania'),
('Sabueso del Tirol'),
('Sabueso Español'),
('Sabueso Estirio de pelo duro'),
('Sabueso Finlandés'),
('Sabueso Francés blanco y negro'),
('Sabueso Francés tricolor'),
('Sabueso Griego'),
('Sabueso Polaco (Ogar Polski)'),
('Sabueso Serbio'),
('Sabueso Suizo'),
('Sabueso Yugoslavo de Montaña'),
('Sabueso Yugoslavo tricolor'),
('Saluki'),
('Samoyedo'),
('San Bernardo'),
('Sarplaninac'),
('Schapendoes'),
('Schipperke'),
('Schnauzer estándar'),
('Schnauzer gigante (Riesenschnauzer)'),
('Schnauzer miniatura (Zwergschnauzer)'),
('Scottish terrier'),
('Sealyham terrier'),
('Segugio Italiano'),
('Seppala Siberiano'),
('Setter Inglés'),
('Setter Irlandés'),
('Setter Irlandés rojo y blanco'),
('Shar Pei'),
('Shiba Inu'),
('Shih Tzu'),
('Shikoku'),
('Skye terrier'),
('Slovensky Cuvac'),
('Slovensky Kopov'),
('Smoushond Holandés'),
('Spaniel Alemán (German Wachtelhund)'),
('Spaniel Azul de Picardía'),
('Spaniel Bretón'),
('Spaniel de Campo'),
('Spaniel de Pont Audemer'),
('Spaniel Francés'),
('Spaniel Tibetano'),
('Spinone Italiano'),
('Spítz Alemán'),
('Spitz de Norbotten (Norbottenspets)'),
('Spitz Finlandés'),
('Spitz Japonés'),
('Staffordshire bull terrier'),
('Staffordshire terrier americano'),
('Sussex Spaniel'),
('Teckel (Dachshund)'),
('Tchuvatch eslovaco'),
('Terranova (Newfoundland)'),
('Terrier australiano (Australian terrier)'),
('Terrier brasilero'),
('Terrier cazador alemán'),
('Terrier checo (Ceský teriér)'),
('Terrier galés'),
('Terrier irlandés (Irish terrier)'),
('Terrier japonés (Nihon teria)'),
('Terrier negro ruso'),
('Terrier tibetano'),
('Tosa'),
('Viejo Pastor Inglés'),
('Viejo Pointer Danés (Old Danish Pointer)'),
('Vizsla'),
('Volpino Italiano'),
('Weimaraner'),
('Welsh springer spaniel'),
('Welsh Corgi Cardigan'),
('Welsh Corgi Pembroke'),
('Welsh terrier'),
('West highland white terrier'),
('Whippet'),
('Wirehaired solvakian pointer'),
('Xoloitzcuintle'),
('Yorkshire Terrier');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int(4) NOT NULL,
  `title` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `dni_cliente` int(8) NOT NULL,
  `cliente` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `asunto` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `id_mascota` int(4) NOT NULL,
  `mascota` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `start` date NOT NULL,
  `domicilio` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `title`, `dni_cliente`, `cliente`, `asunto`, `id_mascota`, `mascota`, `status`, `start`, `domicilio`) VALUES
(31, 'Yacko | Consulta', 45031729, 'Diego Pezet', 'Consulta', 1, 'Yacko', 'Confirmado', '2022-09-06', ''),
(32, 'Fabri | Limpieza quirúrgica de heridas', 45297893, 'Brisa de la Cerda', 'Limpieza quirúrgica de heridas', 2, 'Fabri', 'Confirmado', '2022-08-20', ''),
(33, 'Yacko | Control', 45031729, 'Diego Pezet', 'Control', 1, 'Yacko', 'Cancelado', '2022-08-30', ''),
(34, 'Yacko | Ovarioectomía', 45031729, 'Diego Pezet', 'Ovarioectomía', 1, 'Yacko', 'Confirmado', '2022-09-27', '25 bis N°517'),
(35, 'Yacko | Control', 45031729, 'Diego Pezet', 'Control', 1, 'Yacko', 'Cancelado', '2022-08-26', ''),
(36, 'Yacko | Control postcx', 45031729, 'Diego Pezet', 'Control postcx', 1, 'Yacko', 'Confirmado', '2022-11-15', ''),
(37, 'Yacko | Control general', 45031729, 'Diego Pezet', 'Control general', 1, 'Yacko', 'Confirmado', '2022-09-29', ''),
(38, 'Yacko | Vacunación', 45031729, 'Diego Pezet', 'Vacunación', 1, 'Yacko', 'Confirmado', '2022-09-30', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `dni` int(8) NOT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(10) NOT NULL,
  `domicilio` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`dni`, `email`, `pass`, `nombre`, `apellido`, `telefono`, `domicilio`, `status`) VALUES
(456, 'lukitas@gmail.com', '202cb962ac59075b964b', 'Lucas', 'Santacruz', 116542312, '', 0),
(999, 'randomuser@gmail.com', '202cb962ac59075b964b', 'Random', 'User', 999, 'Random Street 123', 0),
(12345, 'fabrigei@jajaxd.com', '202cb962ac59075b964b', 'Fabri', 'Futryk', 111111111, '', 0),
(12345678, 'patri@gmail.com', '$2y$10$kpNFUXD8zYTIr/mkrIQxX.KUVxK123/LVy159Pwsj6G6PsBQux64C', 'Patricia', 'Placzek', 1234567890, '', 1),
(27192677, 'placzekgaby@gmail.com', '202cb962ac59075b964b', 'Gabriela', 'Placzek', 1112121212, '', 0),
(45031729, 'diegoxd@gmail.com', '$2y$10$kpNFUXD8zYTIr/mkrIQxX.KUVxK123/LVy159Pwsj6G6PsBQux64C', 'Diego', 'Pezet', 12345678, '', 0),
(45297893, 'brisa@gmail.com', '202cb962ac59075b964b', 'Brisa', 'de la Cerda', 12345678, '', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fichas`
--
ALTER TABLE `fichas`
  ADD PRIMARY KEY (`id_ficha`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id_mascota`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fichas`
--
ALTER TABLE `fichas`
  MODIFY `id_ficha` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id_mascota` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
