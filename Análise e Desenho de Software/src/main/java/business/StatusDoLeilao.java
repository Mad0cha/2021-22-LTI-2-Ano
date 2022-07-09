package business;

/**
 * <p>StatusDoLeilao class.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

/**
 * Enumerado com as opcoes possiveis para o estado de um leilao 
 */
public enum StatusDoLeilao {
	/**
	 * Criado (quando um utilizador criou com sucesso um leilao)
	 */
	Criado, 
	/**
	 * Configurado (quando um utilizador configurou com sucesso um leilao)
	 */
	Configurado, 
	/**
	 * Decorrer (quando o leilao esta´ valido e ainda nao chegou a data de 
	 * 			 fim e o seu criador nao o cancelou) 
	 */
	Decorrer, 
	/**
	 * Terminado (quando passa a data de fim definida para o leilao ou quando 
	 *            este e' cancelado pelo seu criador)
	 */
	Terminado, 
	/**
	 * Arquivado (quando um leilao e' fechado)
	 */
	Arquivado, 
	/**
	 * Inválido (quando por uma razao o leilao deixa de ser valido)
	 */
	Inválido
}
