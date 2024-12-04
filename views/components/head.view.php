<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/styles.css">
    <title><?= $title ?></title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        th,
        td {
            padding: 12px;
            text-align: center;


        }

        td {
            border: 1px solid #ddd;
        }

        tr {
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;

        }

        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        li {
            list-style-type: none;
        }

        .actions {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: none;

        }

        .actions button {
            margin: 10px 0;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            width: 100px;
        }

        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
        }

        .btn-add {
            background-color: #4CAF50;
            color: white;
            font-size: 15px;
            border: 1px solid #4CAF50;
            width: fit-content;
        }

        .btn-ajout-form {
            background-color: #007bff;
            color: white;
        }

        .btn-back {
            background-color: white;
            border: #2d3748 1px solid;


        }

        .btn-back a {
            color: black !important;
            text-decoration: none;
        }

        .form-btns {
            margin-top: 15px;
        }

        :root {
            --primary-color: #3490dc;
            --background-color: #f8fafc;
            --text-color: #2d3748;
            --sidebar-width: 250px;
            --header-height: 60px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: var(--text-color);
            background-color: var(--background-color);
        }

        .header {
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
            padding: 0 20px;
            height: var(--header-height);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 1.5rem;
        }

        .logout-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .container {
            display: flex;
            min-height: calc(100vh - var(--header-height));

        }

        .sidebar {
            min-width: var(--sidebar-width);
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;


        }

        .sidebar ul {
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }


        .sidebar li a {
            display: block;
            padding: 20px 20px;
            color: white;
            text-decoration: none;
            font-size: 20px;
            transition: background-color 0.3s;
        }

        .sidebar li a:hover {
            background-color: #34495e;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .icon {
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin-right: 10px;
        }


        .clamp {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* nombre de lignes à afficher */
            -webkit-box-orient: vertical;
            overflow: hidden;
            max-width: 100px;
        }

        .equipments {
            padding: 0;
        }

        .equipments li {
            padding: 2px 0;
        }


        .error-txt {
            font-size: 15px;
            color: red;
        }

        .error {
            margin: 10px 0;
            color: red;
        }

        form {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        label {
            display: block;
            margin-top: 1rem;
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        input[type='email'],
        input[type='password'],
        textarea {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.25rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-family: inherit;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .add {
            margin-bottom: 20px;
        }

        .add button {
            width: fit-content;
            padding: 8px 12px;
            background-color: #007bff;
        }

        .btn a {
            color: white;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
        }

        .item-list {
            margin-top: 1rem;
        }

        .item-input {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .item-input input {
            flex-grow: 1;
        }

        .item-input button {
            width: auto;
            margin-top: 0;
            padding: 0.5rem;
        }

        #items {
            list-style-type: none;
            padding: 0;
        }

        #items li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem;
            background-color: #f8f8f8;
            margin-bottom: 0.5rem;
            border-radius: 4px;
        }

        .equipment-li {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                order: 2;
            }

            .main-content {
                order: 1;
            }
        }

        /* Styles existants pour le body, la sidebar et le header */

        .main-content {
            margin: 0 50px;

        }

        .welcome-section {
            margin-bottom: 30px;
        }

        .welcome-section h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .welcome-section p {
            color: #666;
            font-size: 16px;
        }

        .quick-actions {
            display: flex;
            justify-content: space-between;
            gap: 20px;

        }

        .action-list {
            flex: 1;
            background-color: #2c3e50;

            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .action-list h2 {
            color: white;
            font-size: 20px;
            margin-bottom: 15px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        .action-list ul {
            list-style-type: none;
            padding: 0;
        }

        .action-list li {
            margin-bottom: 10px;
        }

        .action-list a {
            display: block;
            padding: 10px 5px;
            color: #e9e9e9;
            text-decoration: none;
            font-size: 20px;
            font-weight: 500;
            transition: background-color color 0.3s ease;
        }

        .action-list a:hover {
            color: #999;
            background-color: #34495e;
        }

        .add-list {
            padding: 0;
        }

        .delete-form {
            width: fit-content;
            height: fit-content;
            padding: 0;
            background: none;
            box-shadow: none;
        }
    </style>
</head>