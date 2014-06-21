SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `adm_classe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adm_classe` ;

CREATE  TABLE IF NOT EXISTS `adm_classe` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '	' ,
  `nome` VARCHAR(255) NULL DEFAULT NULL ,
  `descricao` TEXT NULL DEFAULT NULL ,
  `ativo` TINYINT(1) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `adm_pessoa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adm_pessoa` ;

CREATE  TABLE IF NOT EXISTS `adm_pessoa` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `discipuladorId` INT(11) NULL DEFAULT NULL ,
  `nome` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `cpf` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `rg` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `endereco` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `complemento` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `numero` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `cep` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `telefoneCelular` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `telefoneResidencial` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `email` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `ativo` TINYINT(1) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Pessoa_Pessoa_idx` (`discipuladorId` ASC) ,
  CONSTRAINT `fk_Pessoa_Pessoa`
    FOREIGN KEY (`discipuladorId` )
    REFERENCES `adm_pessoa` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `adm_matricula`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adm_matricula` ;

CREATE  TABLE IF NOT EXISTS `adm_matricula` (
  `pessoaId` INT(11) NOT NULL ,
  `classeId` INT(11) NOT NULL ,
  `data` DATE NULL DEFAULT NULL ,
  `pagamento` DOUBLE NULL DEFAULT NULL ,
  `aprovado` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `entregaMaterial` TINYINT(1) NULL DEFAULT NULL ,
  `ativo` TINYINT(1) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`pessoaId`, `classeId`) ,
  INDEX `fk_Pessoa_has_Classe_Classe1_idx` (`classeId` ASC) ,
  INDEX `fk_Pessoa_has_Classe_Pessoa1_idx` (`pessoaId` ASC) ,
  CONSTRAINT `fk_Pessoa_has_Classe_Classe1`
    FOREIGN KEY (`classeId` )
    REFERENCES `adm_classe` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pessoa_has_Classe_Pessoa1`
    FOREIGN KEY (`pessoaId` )
    REFERENCES `adm_pessoa` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `adm_pessoa_has_classe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `adm_pessoa_has_classe` ;

CREATE  TABLE IF NOT EXISTS `adm_pessoa_has_classe` (
  `pessoaId` INT(11) NOT NULL COMMENT '	' ,
  `classeId` INT(11) NOT NULL ,
  `data` DATE NULL DEFAULT NULL ,
  PRIMARY KEY (`pessoaId`, `classeId`) ,
  INDEX `fk_adm_pessoa_has_adm_classe_adm_classe1_idx` (`classeId` ASC) ,
  INDEX `fk_adm_pessoa_has_adm_classe_adm_pessoa1_idx` (`pessoaId` ASC) ,
  CONSTRAINT `fk_adm_pessoa_has_adm_classe_adm_classe1`
    FOREIGN KEY (`classeId` )
    REFERENCES `adm_classe` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_adm_pessoa_has_adm_classe_adm_pessoa1`
    FOREIGN KEY (`pessoaId` )
    REFERENCES `adm_pessoa` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
