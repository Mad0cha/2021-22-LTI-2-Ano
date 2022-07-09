package business;

/**
 * <p>Teste de encerrar leilao.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

import static org.junit.Assert.*;

import org.junit.Before;
import org.junit.Test;

/**
 * Classe que testa o terminar de um leilao
 */
public class EncerraLeilaoTest {

	private User user1;
	private CatalogoDeLeiloes c;
	private int idLeilao;
	
	/**
	 * Inicializa um catalogo de leiloes; os utilizadores;
	 * o artigo e o leiao.
	 * Configura, publica e encerra o leilao
	 */
	@Before
	public void setUpBefore() {
		
		this.c = new CatalogoDeLeiloes();
		this.user1 = new User("A");
		int idArtigo = this.user1.criarArtigo("Abajour dos anos 50");
		this.idLeilao = this.user1.criarLeilao("normal", idArtigo);
		this.user1.configurarLeilao(idLeilao, "22/06/2022 21:45:00", 10);
		this.user1.publicaLeilao(idLeilao);
		this.user1.encerraLeilao(idLeilao);
	}
	
	
	/**
	 * Testa o encerrar do leilao e se este e' terminado corretamente
	 */
	@Test
	public void encerra() {
		
		this.user1.encerraLeilao(idLeilao);
		
		Leilao l = this.c.obtemLeilao(idLeilao);
		assertEquals(StatusDoLeilao.Terminado, l.obtemStatusLeilao());
	}

}