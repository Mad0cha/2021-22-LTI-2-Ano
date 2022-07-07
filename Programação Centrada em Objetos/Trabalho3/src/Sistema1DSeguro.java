import java.util.ArrayList;
import java.util.List;

/**
 * Esta classe subclasse de AbstractSistemaSolar, cujas instâncias representam sistemas solares 
 * em que os corpos celestes estão organizados linearmente, sem apresentarem buracos negros nem 
 * espaços null. Um sistema deste tipo tem por base um sistema 2D e funciona como que uma “versão 
 * filtrada” do universo deste, representando somente os elementos que são corpos celestes vulgares.
 * 
 * @author MadalenaRodrigues_55853, PedroAlmeida_56897, RómuloNogueira_56935
 * @date Dezembro 2021
 */

public class Sistema1DSeguro  extends AbstractSistemaSolar{

	// ATRIBUTOS
	private CorpoCeleste [][] m;
	private List<CorpoCeleste> lista;
	private Direcionador d;
	
	
	/* 
	 * Construtor que inicializa um novo objeto com nome nome, tendo por base um sistema 2D com o 
	 * mesmo nome e a matriz m.
	 * A lista linear de corpos celestes fica a conter todos os elementos do sistema 2D associado, 
	 * por ordem crescente, que não são nem null nem buracos negros.
	 * 
	 * @param nome  nome do objeto
	 * @param m  matriz de corpos celestes
	 */
	
	public Sistema1DSeguro(String nome, CorpoCeleste [][] m) {
		
		super(nome);
		this.m = m;
		this.d = new LinhaALinha();
		
		Sistema2D matriz = new Sistema2D(nome, m, d);
		
		this.lista = new ArrayList<CorpoCeleste>();
		
		for (int i = 1; i < matriz.quantosElementos() + 1; i++) {
			
			CorpoCeleste corpo = matriz.getElemento(i);
			
			if (corpo != null && corpo.getClass().getName() != "BuracoNegro") {
				
				this.lista.add(corpo);
			}
		}
	}
	

	
	/*
	 * Devolve o número de elementos da lista de corpos celestes deste sistema
	 * 
	 * @return  número de elementos
	 */
	@Override 
	public int quantosElementos() {
		
		return this.lista.size();
	}

	
	/*
	 * Devolve o (n-1)-ésimo corpo celeste da lista deste sistema solar;
	 * 
	 * @param n  número de ordem do elemento
	 * @requires n >= 0
	 * @return  corpo celeste de ordem n  
	 */
	@Override
	public CorpoCeleste getElemento(int n) {

		return lista.get(n - 1);
	}

	
	/*
	 * Devolve o buraco negro do sistema 2D associado que se encontra mais perto do corpo celeste
	 * 
	 * @param c  corpo celeste em relação ao qual se quer encontrar o buraco negro mais proximo
	 * @return  qual o buraco negro mais próximo de c 
	 */
	@Override
	public BuracoNegro buracoNegroMaisPerto(CorpoCeleste c) {
		
		BuracoNegro maisproximo = null;
		double distancia = Double.MAX_VALUE;

		for (int i = 0; i < this.m.length; i ++) {
			
			for (int j = 0; j < this.m[i].length; j++) {
				
				CorpoCeleste corpo = this.m[i][j];
				
				if (corpo != null && corpo.getClass().getName() == "BuracoNegro" &&
					distancia > c.distancia(corpo)) {
		
						maisproximo = (BuracoNegro) corpo;
						distancia = c.distancia(corpo);
				}
			}
		}
		return maisproximo;
	}
	
	
	/*
	 * Devolve a representação textual do sistema solar
	 */

	public String toString() {

		StringBuilder resultado = new StringBuilder ("Nome: " + this.nome() + "\n");
		
		resultado.append("Planetas: \n"); 

		for (CorpoCeleste corpo : this.lista) {
			
			resultado.append(corpo.posicao().toString() + "   ");
		}
		return resultado.toString();
	}
}
