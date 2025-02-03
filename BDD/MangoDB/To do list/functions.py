from pymongo import MongoClient
from datetime import datetime

# Connexion à MongoDB
client = MongoClient("mongodb://localhost:27017/")
db = client["todolist"]
collection = db["tasks"]

def displayTasks():
    tasks = collection.find()
    for task in tasks:
        print(f"Nom : {task['nom']}\nStatut : {task['statut']}\n")

def addTask():
    task_name = input("Quel est le nom de la tâche que vous voulez ajouter ?\n")
    if collection.find_one_and_delete({"nom": task_name}):
        print("Cette tâche existe déjà")
        addTask()
    else:    
        collection.insert_one({"nom": task_name, "statut": 1})
        print("Tâche ajoutée avec succès")

def completeTask():
    task_name = input("Quel est le nom de la tâche à compléter ?\n")
    task = collection.find_one({"nom": task_name})
    
    if task:
        if task.get("statut") == 0:
            print("Cette tâche est déjà complétée.")
        else:
            collection.update_one(
                {"nom": task_name},
                {"$set": {"statut": 0, "date_completion": datetime.now().strftime("%Y-%m-%d %H:%M:%S")}}
            )
            print(f"Tâche '{task_name}' marquée comme terminée.")
    else:
        print("Cette tâche n'existe pas.")

def deleteTask():
    task_name = input("Quel est le nom de la tâche à supprimer ?\n")
    task = collection.find_one({"nom": task_name})

    if task:
        collection.delete_one({"nom": task_name})
        print(f"Tâche '{task_name}' supprimée avec succès 🗑️")
    else:
        print("Cette tâche n'existe pas.")

def updateTask():
    task_name = input("Quel est le nom de la tâche que vous voulez mettre à jour ?\n")
    task = collection.find_one({"nom": task_name})

    if task:
        new_name = input("Entrez le nouveau nom de la tâche :\n")
        collection.update_one(
            {"nom": task_name},
            {"$set": {"nom": new_name}}
        )
        print(f"Tâche '{task_name}' mise à jour en '{new_name}'.")
    else:
        print("Cette tâche n'existe pas.")
