<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <!-- إضافة SweetAlert2 عبر CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="https://www.bing.com/ck/a?!&&p=56a2961c3cf1dd1dd5ba13025f141fdb0f11bb0e6921b1a14ccd49ba2c85ece3JmltdHM9MTczMTM2OTYwMA&ptn=3&ver=2&hsh=4&fclid=3dd683c7-9bda-6295-1d8a-97c09a4d636c&u=a1L2ltYWdlcy9zZWFyY2g_cT0lRDglQjUlRDklODglRDglQjElRDklODclMjAucG5nJkZPUk09SVFGUkJBJmlkPTZDMTVCMkRFMTE4REI2NjFDMjEyRTk4NzI3QTg0RURBNDZBQTI0NUI&ntb=1" type="image/png">

    <style>
        /* النمط الأساسي */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            text-align: center;
        }
        
        h1 {
            color: #4682b4;
        }

        form {
            margin: 15px 0;
        }

        input[type="text"] {
            padding: 8px;
            width: 150px;  /* تصغير عرض الفورم */
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        button {
            padding: 8px 15px;
            border: none;
            background-color: #7f1abe;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            padding: 10px;
            background-color: #e6f7ff;
            margin: 5px 0;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .completed {
            color: #888;
            text-decoration: line-through;
        }

        .delete-btn {
            background-color: #dc3545;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>To-Do List</h1>

    <!-- إضافة مهمة جديدة -->
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Task title" required>
        <button type="submit">Add Task</button>
    </form>

    <!-- عرض المهام -->
    <ul>
        @foreach ($tasks as $task)
            <li class="{{ $task->completed ? 'completed' : '' }}">
                <span>{{ $task->title }}</span>

                <!-- زر اكتمال المهمة -->
                <form action="{{ route('tasks.update', $task->id) }}" method="POST" style="display: inline-block; margin-right: 10px;">
                    @csrf
                    @method('PUT')
                    <button type="submit" style="background-color: #20c997; color: #fff;">{{ $task->completed ? 'Undo' : 'Complete' }}</button>
                </form>

                <!-- زر الحذف مع SweetAlert -->
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline-block;" onsubmit="confirmDelete(event)">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <script>
        function confirmDelete(event) {
            event.preventDefault(); // منع إرسال النموذج مباشرة
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();  // إرسال النموذج بعد التأكيد
                }
            });
        }
    </script>
</body>
</html>
