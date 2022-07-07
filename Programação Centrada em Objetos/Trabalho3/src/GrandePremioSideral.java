import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

/**
 * Classe cujas instâncias representam grandes prémios siderais que se realizam sobre um dado sistema 
 * solar e em que vários viajantes vão fazendo jogadas (escolhas dos destinos para viagens no sistema 
 * solar). Define um prémio base que cada viajante recebe por visitar um dado corpo celeste. O prémio
 * é maior em viagens de risco (aquelas para planetas a uma distância de risco de um buraco negro) e
 * mais pequeno em determinadas condições.
 * 
 * @author MadalenaRodrigues_55853, PedroAlmeida_56897, RómuloNogueira_56935
 * @date Dezembro 2021
 */

public class GrandePremioSideral {

	// ATRIBUTOS DA CLASSE
	public static int TAXA_RISCO = 5;
	public static int PONTOS_BURACO_NEGRO = Integer.MAX_VALUE;

	// ATRIBUTOS DA INSTÂNCIA
	private int premioBase;
	private Map<String, Viajante> viajantes;
	private SistemaSolar sistema;

	
	/* Construtor que inicializa um novo grande prémio a realizar no sistema solar ss, com os viajantes
	 * contidos em jogs e um prémio base igual a premioBase
	 * 
	 * @param ss  sistema solar onde irá decorrer o grande prémio
	 * @param jogs  lista de viajantes/jogadores do grande prémio
	 * @param premioBase  prámio base para este grande prémio
	 */
	
	public GrandePremioSideral(SistemaSolar ss, List<Viajante> jogs, int premioBase){
		
		this.premioBase = premioBase;
		this.sistema = ss;
		this.viajantes = new HashMap();

		for (Viajante v : jogs) {
			
			this.viajantes.put(v.nome(), v);
		}
	}
	
	
	/*
	 * Retorna o prémio base definido para este grande prémio
	 * 
	 * @returns  prémio base
	 */
	
	public int premioBase() {
		
		return this.premioBase;
	}

	
	/* Regista as jogadas dos vários viajantes que participam no grande prémio
	 * 
	 * @param jogadas  lista de pares com o nome e número das jogadas
	 * @requires  jogadas != null
	 * @requires  String != null
	 * @requires  Integer != null
	 */
	public void fazJogada(List <Par<String, Integer>> jogadas) {
		
		for (int i = 0; i < jogadas.size(); i++) {
			
			CorpoCeleste c = this.sistema.getElemento(jogadas.get(i).segundo());
			Viajante v = this.viajantes.get(jogadas.get(i).primeiro());
			
			if(c != null) {
				
				if(v.podeViajar(c.posicao()) && !(c.posicao().equals(v.posicaoGlobal()))) {
					
					v.mudaPosicaoGlobal(c.posicao());
					
					if (c.getClass().getName() == "BuracoNegro") {
						
						v.registaPontos(-PONTOS_BURACO_NEGRO);
					}
					else {
						
						BuracoNegro buracoNegroMaisProximo = this.sistema.buracoNegroMaisPerto(c);
						double distanciaMinimaSeguranca = buracoNegroMaisProximo.distanciaMinimaSeguranca(c);
						
						if(c.distancia(buracoNegroMaisProximo) < distanciaMinimaSeguranca) {
							
							v.registaPontos(this.premioBase * TAXA_RISCO);
							
						}
						else {
							v.registaPontos(this.premioBase);
						}
					}
				}
				else {
					v.registaPontos(-(v.pontuacao()/5));
				}
			}
			else { // SE c FOR NULL
				v.registaPontos(-(v.pontuacao()/2));
			}
		}	
	}

	
	/*
	 * Devolve o(s) nome(s) do(s) viajante(s) que obteve(obtiveram) a maior pontuação
	 * 
	 * @returns jogador/jogadores com maior pontuação
	 */
	
	public List<String> vencedores(){
		
		List <String> resultado = new ArrayList<String>();
		
		for (Viajante v : this.viajantes.values()) { 
			
			int pontuacao = v.pontuacao(); 
			
			if(pontuacao == this.maximaPontuacao()) {
				
				resultado.add(v.nome());
			}
		}
		return resultado;
	}
	

	/*
	 * Devolve a pontuação máxima 
	 * 
	 * @returns pontuação máxima
	 */
	public int maximaPontuacao() {
		int maxima = 0;
		
		for (Viajante v : this.viajantes.values()) { 
			
			if(v.pontuacao() > maxima) {
				
				maxima = v.pontuacao();
			}
		}
		return maxima;
	}

	
	/**
	 * Devolve a representação textual do grande prémio
	 */
	
	public String toString() {
		
		StringBuilder resultado = new StringBuilder("============ GRANDE PREMIO ============" + "\n"
													+ "Premio base: " + this.premioBase + "\n" 
													+ "Sistema Solar:  \n" 
													+ this.sistema.toString() + "\n" 
													+ "Viajantes: \n");
													
		for (Viajante v: this.viajantes.values()) {
			
			resultado.append(v.toString());
		}
		return resultado.toString();
	}
	
}
