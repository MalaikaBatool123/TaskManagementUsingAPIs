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
                        <!-- Title input -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" />
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>

                        <!-- Status dropdown -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status"></select>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary" id="saveChangesBtn">
                                Save changes
                            </button> -->
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Done
                            </button>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" id="saveChangesBtn">
                        Save changes
                    </button>
                </div> -->
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
                                @foreach ($statusOptions as $status)
                                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                @endforeach
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
        document.getElementById('addTaskForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission
            const formData = new FormData(this);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Map field names to remove "add-" prefix
            const mappedFormData = new FormData();
            for (const [key, value] of formData.entries()) {
                const newKey = key.replace('add-', ''); // Remove the prefix
                mappedFormData.append(newKey, value);
            }

            fetch('/api/add/tasks', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: mappedFormData // Send the modified FormData
            })
                .then(response => {
                    if (!response.ok) { // Check if the response is not ok (status code not 2xx)
                        if (response.status === 422) {
                            // Handle validation errors specifically
                            return response.json().then(data => {
                                // Display validation error messages (e.g., using a modal or inline alerts)
                                const errors = data.errors;
                                for (const field in errors) {
                                    const errorMessages = errors[field];
                                    alert(errorMessages);
                                }
                            });
                        } else {
                            // Handle other errors (e.g., 500 Internal Server Error)
                            throw new Error('Something went wrong. Please try again.');
                        }
                    }
                    return response.json(); // Parse the successful response as JSON
                })
                .then(data => {
                    // Handle the successful response from the API
                    console.log('Task created successfully:', data);
                    // Update the UI to reflect the new task (e.g., add a row to the table)
                    // ... (You'll need to add your specific UI update logic here)

                    // Optionally, reset the form
                    this.reset();
                    location.reload();
                })
                .catch(error => {
                    // Handle any errors that occurred during the request
                    console.error('Error creating task:', error.message);

                    // Display a generic error message to the user
                    alert(error.message);
                });
        });


        const editButtons = document.querySelectorAll('.edit-btn');

        // Attach a click event listener to each edit button
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const taskId = this.getAttribute('data-task-id');

                // Fetch the existing task data using the edit route
                fetch(`/api/tasks/${taskId}/edit`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Could not fetch task details.');
                        }
                        return response.json();
                    })
                    .then(taskData => {
                        console.log(taskData)
                        // Populate the form fields with the fetched data
                        document.getElementById('taskId').value = taskData.data.id;
                        document.getElementById('title').value = taskData.data.title;
                        document.getElementById('description').value = taskData.data.description;
                        // document.getElementById('status').value = taskData.data.status;
                        const statusSelect = document.getElementById('status');
                        statusSelect.innerHTML = ''; // Clear existing options

                        // Create a new option element for the already saved status
                        const savedStatusOption = document.createElement('option');
                        savedStatusOption.value = taskData.data.status;
                        savedStatusOption.text = taskData.data.status.charAt(0).toUpperCase() + taskData.data.status.slice(1);
                        savedStatusOption.selected = true; // Set as selected
                        statusSelect.add(savedStatusOption, 0); // Add it at the beginning

                        // Populate the select with options fetched from the api
                        taskData.statusOptions.forEach(status => {
                            const option = document.createElement('option');
                            option.value = status;
                            option.text = status.charAt(0).toUpperCase() + status.slice(1); // Capitalize the first letter
                            statusSelect.add(option);
                        });
                        // (Optionally) show the update modal if you're using one
                        // ... (e.g., $('#updateModal').modal('show');)
                    })
                    .catch(error => {
                        console.error('Error fetching task:', error.message);
                        alert('An error occurred while fetching the task details.');
                    });
            });
        });

        // Update task submission handling (add this outside the loop)
        document.getElementById('taskForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(this);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const taskId = document.getElementById('taskId').value; // Get the task ID

            fetch(`/api/tasks/${taskId}/edit`, {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    taskId: document.getElementById('taskId').value,
                    title: document.getElementById('title').value,
                    description: document.getElementById('description').value,
                    status: document.getElementById('status').value,
                })
            })
                .then(response => {
                    if (!response.ok) {
                        if (response.status === 422) {
                            return response.json().then(data => {
                                const errors = data.errors;
                                for (const field in errors) {
                                    const errorMessages = errors[field];
                                    alert(errorMessages); // Display error messages to the user
                                }
                            });
                        } else {
                            throw new Error('Something went wrong. Please try again later.');
                        }
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Task updated successfully:', data);
                    // setTimeout(function() {
                    location.reload(); // Refresh the entire page
                    // }, 500); 
                    // Update the UI to reflect the changes 
                    const taskRow = document.querySelector(`tr[data-task-id="${taskId}"]`);
                    if (taskRow) {
                        taskRow.querySelectorAll('td')[0].textContent = data.data.title; // update the first td i.e title
                        taskRow.querySelectorAll('td')[1].textContent = data.data.description; //update the second td i.e description
                        taskRow.querySelectorAll('td')[2].textContent = data.data.status; //update the third td i.e status
                    }


                })
                .catch(error => {
                    console.error('Error updating task:', error.message);
                    alert(error.message); // Display error message to the user
                });
        });


        // Get all delete buttons
        const deleteButtons = document.querySelectorAll('.del-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const taskId = this.getAttribute('data-task-id');

                if (confirm('Are you sure you want to delete this task?')) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    fetch(`/api/tasks/${taskId}/delete`, {
                        method: 'DELETE',  // Use DELETE for deleting
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Could not delete task.');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Task deleted successfully:', data);

                            // Remove the deleted task from the table
                            const taskRow = document.querySelector(`tr[data-task-id="${taskId}"]`);
                            if (taskRow) {
                                taskRow.remove();
                            }
                            location.reload();
                        })
                        .catch(error => {
                            location.reload();
                            // console.error('Error deleting task:', error.message);
                            // alert('An error occurred while deleting the task.');
                        });
                }
            });
        });


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>