from pymongo import MongoClient
from datetime import datetime

# Connexion à MongoDB
client = MongoClient("mongodb://localhost:27017/")
db = client["gestion_taches"]
collection = db["taches"]

def afficher_taches():
    taches = collection.find()
    for tache in taches:
        print(f"ID: {tache['_id']}, Tâche: {tache['description']}, Statut: {tache['statut']}, Date: {tache.get('date_completion', 'Non complétée')}")

def ajouter_tache(description):
    collection.insert_one({"description": description, "statut": "En cours", "date_creation": datetime.now()})
    print("Tâche ajoutée avec succès!")

def completer_tache(tache_id):
    collection.update_one({"_id": tache_id}, {"$set": {"statut": "Terminée", "date_completion": datetime.now()}})
    print("Tâche complétée!")

def supprimer_tache(tache_id):
    collection.delete_one({"_id": tache_id})
    print("Tâche supprimée!")

def mettre_a_jour_tache(tache_id, nouvelle_description):
    collection.update_one({"_id": tache_id}, {"$set": {"description": nouvelle_description}})
    print("Tâche mise à jour!")

def menu():
    while True:
        print("\nMenu:")
        print("1. Afficher les tâches")
        print("2. Ajouter une tâche")
        print("3. Compléter une tâche")
        print("4. Supprimer une tâche")
        print("5. Mettre à jour une tâche")
        print("6. Quitter")
        choix = input("Votre choix: ")

        if choix == "1":
            afficher_taches()
        elif choix == "2":
            description = input("Entrez la description de la tâche: ")
            ajouter_tache(description)
        elif choix == "3":
            tache_id = input("Entrez l'ID de la tâche à compléter: ")
            completer_tache(tache_id)
        elif choix == "4":
            tache_id = input("Entrez l'ID de la tâche à supprimer: ")
            supprimer_tache(tache_id)
        elif choix == "5":
            tache_id = input("Entrez l'ID de la tâche à mettre à jour: ")
            nouvelle_description = input("Nouvelle description: ")
            mettre_a_jour_tache(tache_id, nouvelle_description)
        elif choix == "6":
            break
        else:
            print("Choix invalide!")

if __name__ == "__main__":
    menu()