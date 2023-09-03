create database atm;

USE atm;


-- USUARIOS --
DROP TABLE IF EXISTS usuarios;
CREATE TABLE `usuarios` (
  `id` int auto_increment primary key,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nivel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- CLIENTES  --
DROP TABLE IF EXISTS clientes;
CREATE TABLE `clientes` (
  `id_cliente` int auto_increment primary key,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `cpf_cnpj` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ORÇAMENTOS --
DROP TABLE IF EXISTS orcamentos;
CREATE TABLE `orcamentos` (
  `id_orcamento` int auto_increment primary key,
  `total_orcamento` decimal(8,2),
  `dt_entrada` date,
  `hr_entrada` time,
  `dt_saida` date,
  `hr_saida` time,
  `cliente` varchar(100),
  `celular` varchar(50),
  `telefone` varchar(50),
  `cep` varchar(10),
  `endereco` varchar(150),
  `numero` varchar(5),
  `bairro` varchar(100),
  `cidade` varchar(100),
  `placa` varchar(10),
  `veiculo` varchar(70),
  `modelo` varchar(80),
  `cor` varchar(20),
  `km_atual` varchar(20),
  `problema` varchar(200),
  `laudo` varchar(200),
  `observacoes` varchar(200),
  `total_pro` decimal(10,2),
  `total_ser` decimal(10,2),
  `total_bruto` decimal(10,2),
  `total_liq` decimal(10,2),
  `entrada` decimal(10,2),
  `desconto` decimal(10,2),
  `status` varchar(100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS servicos;
CREATE TABLE `servicos` (
  id_servico int auto_increment primary key,
  servico varchar(200),
  descricao varchar(250),
  preco decimal(10,2),
  id_orcamento int
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS produtos_vnd;
CREATE TABLE `produtos_vnd` (
  id_vnd int auto_increment primary key,
  id_prod int(4),
  quantidade decimal(10,2),
  total decimal(10,2),
  id_orcamento int
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- PRODUTOS --
DROP TABLE IF EXISTS produtos;
CREATE TABLE `produtos` (
  `id` int auto_increment primary key,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(200),
  `estoque` decimal(8,2),
  `minimo` decimal(8,2) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `categoria` int(11) NOT NULL,
  `dt_val` date
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS categorias;
CREATE TABLE `categorias` (
  `id` int auto_increment primary key,
  `nome` varchar(50) NOT NULL,
  `foto` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- VENDAS
DROP TABLE IF EXISTS vendas;
CREATE TABLE `vendas` (
  `id` int auto_increment primary key,
  `valor` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `operador` int(11) NOT NULL,
  `valor_recebido` decimal(8,2) NOT NULL,
  `desconto` varchar(20) NOT NULL,
  `troco` decimal(8,2) NOT NULL,
  `forma_pgto` int(11) NOT NULL,
  `abertura` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `nome` varchar (100),
  `placa` varchar(15)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- PAGAMENTOS
DROP TABLE IF EXISTS pagamentos;
CREATE TABLE `pagamentos` (
  `id` int auto_increment primary key,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;