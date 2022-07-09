package business;

/**
 * <p>Teste do formulario de reputacoes.</p>
 *
 * @author Grupo12: MadalenaRodrigues_55853, PedroAlmeida_56897, RomuloNogueira_56935
 * @version $Id: $Id
 */

import static org.junit.Assert.*;

import org.junit.Before;
import org.junit.Test;

/**
 * Classe que testa o funcionamento do formulario de reputacoes
 */
public class FormularioReputacaoTest {

	private User vendedor;
	private User comprador;
	private int idLeilao;
	
	/**
	 * Cria os utilizadores; cria o artigo e o leiao.
	 * Configura, publica, licita e encerra o leilao
	 */
	@Before
	public void setUpBefore() {
		
		this.vendedor = new User ("A");
		this.comprador = new User ("B");
		
		int idArtigo = vendedor.criarArtigo("mala de viagem");
		this.idLeilao = vendedor.criarLeilao("normal", idArtigo);
		vendedor.configurarLeilao(idLeilao, "31/07/2022 23:59:59", 10);
		vendedor.publicaLeilao(idLeilao);
		
		Leilao leilao = comprador.obtemLeilao(idLeilao);
		comprador.licitarLeilao(idLeilao, 5);
		vendedor.encerraLeilao(idLeilao);
	}
	
	
	/**
	 * Testa a atribuicao de reputacao a um vendedor 
	 * assim como o funcionamento do formulario
	 */
	@Test
	public void reputacaoVendedor() {
		
		Reputacao rep_vendedor = comprador.formularioReputacao(idLeilao, Reputacao.EXCELENTE);
		vendedor.adicionaReputacao(rep_vendedor);

		assertSame(vendedor.obtemReputacao(), Reputacao.EXCELENTE);
	}
	
	
	/**
	 * Testa a atribuicao de reputacao a um comprador 
	 * assim como o funcionamento do formulario
	 */
	@Test
	public void rePutacaoComprador() {

		Reputacao rep_comprador = vendedor.formularioReputacao(idLeilao, Reputacao.SUFICIENTE);
		comprador.adicionaReputacao(rep_comprador);
		
		assertSame(comprador.obtemReputacao(), Reputacao.SUFICIENTE);
	}

}