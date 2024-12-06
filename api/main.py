from fastapi import FastAPI
import httpx

app = FastAPI()

# Base URL de la PokeAPI
POKEAPI_URL = "https://pokeapi.co/api/v2/pokemon"

@app.get("/")
def root():
    return {"message": "Bienvenido a la API de Pokémon"}

@app.get("/pokemon/{pokemon_name}")
async def get_pokemon(pokemon_name: str):
    """
    Endpoint para obtener datos de un Pokémon por su nombre desde la PokeAPI.
    """
    try:
        # Realizar la solicitud a la PokeAPI
        async with httpx.AsyncClient() as client:
            response = await client.get(f"{POKEAPI_URL}/{pokemon_name}")
            response.raise_for_status()
        
        # Procesar los datos del Pokémon
        data = response.json()
        return {
            "nombre": data.get("name"),
            "id": data.get("id"),
            "tipo": [t["type"]["name"] for t in data["types"]],
            "altura": data.get("height"),
            "peso": data.get("weight"),
            "imagen": data["sprites"]["front_default"],  # URL de la imagen
        }
    except httpx.HTTPStatusError as e:
        return {"error": f"Pokémon '{pokemon_name}' no encontrado. {e}"}
    except Exception as e:
        return {"error": f"Algo salió mal: {str(e)}"}
    

@app.get("/pokemon")
async def get_pokemon_all():
    """
    Endpoint para obtener datos de un Pokémon por su nombre desde la PokeAPI.
    """
    try:
        # Realizar la solicitud a la PokeAPI
        async with httpx.AsyncClient() as client:
            # response = await client.get(f"{POKEAPI_URL}/{pokemon_name}")
            response = await client.get(f"{POKEAPI_URL}?limit=10&offset=0")
            data = response.json() 
        
        pokemon_list = data["results"]
        pokemon_details = []
        
        async with httpx.AsyncClient() as client:
            for pokemon in pokemon_list:
                # Hacemos una solicitud para obtener los detalles de cada Pokémon usando la URL proporcionada
                poke_response = await client.get(pokemon["url"])
                poke_data = poke_response.json()
                
                # Extraemos la información que necesitamos: nombre, imagen, y otros detalles
                pokemon_details.append({
            
                    "nombre": poke_data.get("name"),
                    "id": poke_data.get("id"),
                    "tipo": [t["type"]["name"] for t in poke_data["types"]],
                    "imagen": poke_data["sprites"]["front_default"],  # URL de la imagen
                })
        return {"pokemons": pokemon_details}
    
    except httpx.HTTPStatusError as e:
        return {"error": f"Pokémon no encontrado. {e}"}
    except Exception as e:
        return {"error": f"Algo salió mal: {str(e)}"}