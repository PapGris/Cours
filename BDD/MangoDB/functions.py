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
        print("Tâche ajoutée")