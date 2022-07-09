package business;

/**
 * <p>Teste de reputacoes.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

import static org.junit.Assert.*;

import org.junit.Before;
import org.junit.Test;

/**
 * Classe que valida o cálculo da média das reputações atribuídas a um utilizador
 */
public class MediaReputacaoTest {

	private User vendedor;
	private User comprador;

	/**
	 * Cria os utilizadores
	 */
	@Before
	public void setUpBefore() {
		
		this.vendedor = new User("A");
		this.comprador = new User("B");
	}
	
	
	/**
	 * Valida o cálculo da média das reputações atribuídas a um vendedor
	 */
	@Test
	public void reputacaoVendedor() {
		
		vendedor.adicionaReputacao(Reputacao.MA);
		vendedor.adicionaReputacao(Reputacao.MA);
		vendedor.adicionaReputacao(Reputacao.BOA);
		assertSame(vendedor.obtemReputacao(), Reputacao.SUFICIENTE);
	}
	
	
	/**
	 * Valida o cálculo da média das reputações atribuídas a um comprador
	 */
	@Test
	public void reoutacaoComprador() {

		comprador.adicionaReputacao(Reputacao.BOA);
		comprador.adicionaReputacao(Reputacao.EXCELENTE);
		assertSame(comprador.obtemReputacao(), Reputacao.EXCELENTE);
	}
	
}