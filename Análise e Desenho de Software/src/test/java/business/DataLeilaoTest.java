package business;

/**
 * <p>Teste de data de leilao.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

import static org.junit.Assert.*;

import org.junit.Before;
import org.junit.Test;

/**
 * Classe que testa a definicao da data de um leilao
 */
public class DataLeilaoTest {

	private User vendedor;
	private User comprador;
	private int idLeilao;
	
	/**
	 * Inicializa os utilizadores; cria o artigo e o leilao
	 */
	@Before
	public void setUpBefore() {
		
		this.vendedor = new User("A");
		this.comprador = new User("B");
		
		int idArtigo = vendedor.criarArtigo("candeeiro");
		this.idLeilao = vendedor.criarLeilao("normal", idArtigo);
	}
	
	
	/**
	 * Testa a configuracao de um leilao numa data passada
	 */
	@Test
	public void leilaoAntigo() {
		
		vendedor.configurarLeilao(idLeilao, "10/10/1950 10:10:00", 100);
		Leilao leilao = vendedor.obtemLeilao(idLeilao);
		boolean ret = leilao.validaLicitacao(new Licitacao(comprador, 200, leilao));
		assertFalse(ret);
	}

}