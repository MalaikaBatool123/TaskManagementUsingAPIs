<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Freeman&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet" />
    <style>
        * {
            font-family: "Roboto", sans-serif;
        }

        .roboto-regular {
            font-weight: 400;
            font-style: normal;
        }

        .center {
            text-align: center;
        }

        .red {
            color: red;
        }

        .green {
            color: green;
        }

        .full {
            width: 100%;
        }

        button.add-btn {
            border: 1px solid black;
        }

        button.add-btn:hover {
            background-color: black;
            color: white;
        }

        .end-col {
            display: flex;
            justify-content: end;
        }

        table th,
        table td {
            text-align: center !important;
        }

        .modal form {
            display: flex;
            flex-direction: column;
        }

        .modal form input,
        .modal form textarea {
            border: 1px solid lightgray;
            outline: none;
            padding: 10px 20px;
            margin: 5px 0;
            border-radius: 5px;
        }

        .modal form label {
            font-size: 12px;
            color: grey;
        }

        table thead,
        th {
            background: darkgray;
            color: black !important;

        }

        table tr:nth-child(even) {
            background: lightgray;
        }

        table {
            margin: 10px auto;
        }
    </style>
</head>

<body>
    <x-app-layout>



        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="container full">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-6">
                                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">Tasks</h3>
                                </div>
                                <div class="col-6 end-col">
                                    <button data-bs-toggle="modal" data-bs-target="#addModal"
                                        class="add-btn btn">Add</button>
                                </div>
                            </div>
                        </div>
                        <table class="full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Edit
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Delete
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tasks-table-body" class="bg-white divide-y divide-gray-200">
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $task->title }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $task->description }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $task->status }}
                                        </td>
                                        <td class="center px-6 py-4 whitespace-nowrap text-gray-900">
                                            <button type="button" data-task-id="{{ $task->id }}"
                                                class="green fa-solid fa-pen-to-square edit-btn font-sm"
                                                data-bs-toggle="modal" data-bs-target="#updateModal"></button>
                                        </td>

                                        <td class="center px-6 py-4 whitespace-nowrap text-gray-900">
                                            <button type="button" data-task-id="{{ $task->id }}"
                                                class="red fa-solid fa-trash del-btn font-sm"></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">
                        Update Task
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="taskForm">
                        @csrf
                        <input type="hidden" id="taskId" name="taskId" />
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" />
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status"></select>
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Done
                            </button>
                        </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">
                        Add Task
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTaskForm">
                        @csrf
                        <div class="mb-3">
                            <label for="add-title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="add-title" id="add-title"
                                placeholder="Add title" />

                        </div>

                        <div class="mb-3">
                            <label for="add-description" class="form-label">Description</label>
                            <textarea class="form-control" name="add-description" id="add-description"
                                placeholder="Add Description"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="add-status" class="form-label">Status</label>
                            <select class="form-select" name="add-status" id="add-status">
                               <option value="pending">pending</option>
                               <option value="in-progress">in-progress</option>
                               <option value="completed">completed</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Done
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // const tasksTableBody = document.getElementById('tasks-table-body');

        // fetch('/api/tasks') // Fetch data from your API endpoint
        //     .then(response => response.json())
        //     .then(data => {
        //         data.data.forEach(task => {
        //             const row = `
        //         <tr>
        //             <td>${task.title}</td>
        //             <td>${task.description}</td>
        //             <td>${task.status}</td>
        //             <td>
        //                 <button type="button" data-task-id="${task.id}" class="edit-btn">Edit</button>
        //             </td>
        //             <td>
        //                 <button type="button" data-task-id="${task.id}" class="del-btn">Delete</button>
        //             </td>
        //         </tr>
        //     `;
        //             tasksTableBody.innerHTML += row;
        //         });
        //     })
        //     .catch(error => {
        //         console.error('Error fetching tasks:', error);
        //         // Handle errors appropriately (e.g., display an error message)
        //     });
        const TaskManager = (() => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const fetchWrapper = async (url, method, body = null, headers = {}) => {
        const defaultHeaders = {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        };
        headers = { ...defaultHeaders, ...headers };
        const response = await fetch(url, { method, headers, body });
        if (!response.ok) {
            if (response.status === 422) {
                const data = await response.json();
                const errors = data.errors;
                for (const field in errors) {
                    const errorMessages = errors[field];
                    alert(errorMessages);
                }
            } else {
                throw new Error('Something went wrong. Please try again.');
            }
        }
        return response.json();
    };

    const mapFormData = (formData, prefix) => {
        const mappedFormData = new FormData();
        for (const [key, value] of formData.entries()) {
            const newKey = key.replace(prefix, ''); // Remove the prefix
            mappedFormData.append(newKey, value);
        }
        return mappedFormData;
    };

    const handleFormSubmit = async (event, url, method, prefix = 'add-', callback) => {
        event.preventDefault();
        const formData = new FormData(event.target);
        const mappedFormData = mapFormData(formData, prefix);
        const body = method === 'POST' ? mappedFormData : JSON.stringify(Object.fromEntries(mappedFormData));
        const headers = method === 'POST' ? {} : { 'Content-Type': 'application/json' };

        try {
            const data = await fetchWrapper(url, method, body, headers);
            console.log('Task processed successfully:', data);
            event.target.reset();
            if (callback) callback(data);
        } catch (error) {
            console.error('Error processing task:', error.message);
            alert(error.message);
        }
    };

    const initAddTaskForm = () => {
        const form = document.getElementById('addTaskForm');
        form.addEventListener('submit', (event) => {
            handleFormSubmit(event, '/api/add/tasks', 'POST', 'add-', () => location.reload());
        });
    };

    const initEditButtons = () => {
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', async function () {
                const taskId = this.getAttribute('data-task-id');
                try {
                    const taskData = await fetchWrapper(`/api/tasks/${taskId}/edit`, 'GET');
                    populateEditForm(taskData);
                } catch (error) {
                    console.error('Error fetching task:', error.message);
                    alert('An error occurred while fetching the task details.');
                }
            });
        });
    };

    const populateEditForm = (taskData) => {
        document.getElementById('taskId').value = taskData.data.id;
        document.getElementById('title').value = taskData.data.title;
        document.getElementById('description').value = taskData.data.description;
        const statusSelect = document.getElementById('status');
        statusSelect.innerHTML = '';
        const savedStatusOption = new Option(taskData.data.status, taskData.data.status, true, true);
        statusSelect.add(savedStatusOption, 0);
        taskData.statusOptions.forEach(status => {
            const option = new Option(status.charAt(0).toUpperCase() + status.slice(1), status);
            statusSelect.add(option);
        });
    };

    const initEditTaskForm = () => {
        const form = document.getElementById('taskForm');
        form.addEventListener('submit', (event) => {
            const taskId = document.getElementById('taskId').value;
            handleFormSubmit(event, `/api/tasks/${taskId}/edit`, 'PUT', '', (data) => {
                updateTaskRow(data.data);
                location.reload();
            });
        });
    };

    const updateTaskRow = (taskData) => {
        const taskRow = document.querySelector(`tr[data-task-id="${taskData.id}"]`);
        if (taskRow) {
            taskRow.querySelectorAll('td')[0].textContent = taskData.title;
            taskRow.querySelectorAll('td')[1].textContent = taskData.description;
            taskRow.querySelectorAll('td')[2].textContent = taskData.status;
        }
    };

    const initDeleteButtons = () => {
        document.querySelectorAll('.del-btn').forEach(button => {
            button.addEventListener('click', function () {
                const taskId = this.getAttribute('data-task-id');
                if (confirm('Are you sure you want to delete this task?')) {
                    fetchWrapper(`/api/tasks/${taskId}/delete`, 'DELETE')
                        .then(data => {
                            console.log('Task deleted successfully:', data);
                            const taskRow = document.querySelector(`tr[data-task-id="${taskId}"]`);
                            if (taskRow) taskRow.remove();
                            location.reload();
                        })
                        .catch(error => {
                            console.error('Error deleting task:', error.message);
                            location.reload();
                        });
                }
            });
        });
    };

    return {
        init: () => {
            initAddTaskForm();
            initEditButtons();
            initEditTaskForm();
            initDeleteButtons();
        }
    };
})();

document.addEventListener('DOMContentLoaded', () => {
    TaskManager.init();
});

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>