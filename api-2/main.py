from fastapi import FastAPI, HTTPException
import httpx

# Crear instancia de FastAPI
app = FastAPI()

# URL de la Dragon Ball API
DRAGON_BALL_API_URL = "https://dragonball-api.com/api"

# Ruta de bienvenida
@app.get("/", tags=["Root"])
async def root():
    """
    Ruta de bienvenida.
    """
    return {"message": "Welcome to the Dragon Ball Proxy API! Use /characters to list all characters."}


@app.get("/characters/goku", tags=["Custom"])
async def goku_aparece():
    """
    Ruta personalizada para obtener información sobre Goku.
    """
    try:
        async with httpx.AsyncClient() as client:
            # Consulta a la API externa para obtener la información de Goku
            response = await client.get(f"{DRAGON_BALL_API_URL}/characters/1")
            response.raise_for_status()
        data = response.json()

        # Personalizamos la respuesta para esta ruta
        return {
            "message": "¡Goku ha aparecido!",
            "data": {
                "id": data.get("id"),
                "nombre": data.get("name"),
                "ki_actual": data.get("ki"),
                "ki_maximo": data.get("maxKi"),
                "raza": data.get("race"),
                "genero": data.get("gender"),
                "imagen": data.get("image"),
            },
        }
    except httpx.HTTPStatusError as e:
        return {"error": f"No se pudo obtener la información de Goku. {e}"}
    except Exception as e:
        return {"error": f"Algo salió mal: {str(e)}"}

@app.get("/characters/{id_character}")
async def get_character(id_character:str):
    try:
        async with httpx.AsyncClient() as client:
            response = await client.get(f"{DRAGON_BALL_API_URL}/characters/{id_character}")
            response.raise_for_status()
        data = response.json()
        return {
            "id" : data.get("id"),
            "nombre" : data.get("name"),
            "ki" : data.get('ki'),
            "maxKi" : data.get('maxKi'),
            "raza" : data.get('race'),
            "genero" : data.get('gender'),
            "img" : data.get('image')
        }
    except httpx.HTTPStatusError as e:
        return {"error": f"Personaje no encontrado. {e}"}
    except Exception as e:
        return {"error": f"Algo salió mal: {str(e)}"}

@app.get("/planets/{id_planeta}")
async def get_planet(id_planeta:str):
    try:
        async with httpx.AsyncClient() as client:
            response = await client.get(f"{DRAGON_BALL_API_URL}/planets/{id_planeta}")
            response.raise_for_status()
        data = response.json()
        return {
            "id" : data.get("id"),
            "nombre" : data.get("name"),
            "isDestroyed" : data.get('isDestroyed'),
            "descripcion" : data.get('descripcion'),
            "img" : data.get('image')
        }
    except httpx.HTTPStatusError as e:
        return {"error": f"Planeta no encontrado. {e}"}
    except Exception as e:
        return {"error": f"Algo salió mal: {str(e)}"}

@app.get("/planets")
async def get_all_planets():
    try:
        async with httpx.AsyncClient() as client:
            response = await client.get(f"{DRAGON_BALL_API_URL}/planets")
            response.raise_for_status()
        data = response.json()
        return data
    except httpx.HTTPStatusError as e:
        return {"error": f"Planeta no encontrado. {e}"}
    except Exception as e:
        return {"error": f"Algo salió mal: {str(e)}"}

@app.get("/characters")
async def get_all_character():
    try:
        async with httpx.AsyncClient() as client:
            response = await client.get(f"{DRAGON_BALL_API_URL}/characters")
            response.raise_for_status()
        data = response.json()
        return data['items']
    except httpx.HTTPStatusError as e:
        return {"error": f"Personaje no encontrado. {e}"}
    except Exception as e:
        return {"error": f"Algo salió mal: {str(e)}"}
