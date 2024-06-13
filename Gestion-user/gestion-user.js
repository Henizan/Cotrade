function loadUsers() {
    fetch('../php/get_users.php')
        .then(response => response.json())
        .then(data => {
            const userList = document.getElementById('user-list');
            userList.innerHTML = '';
            data.forEach(user => {
                const listItem = document.createElement('li');
                listItem.textContent = user.username;
                userList.appendChild(listItem);
            });
        });
}

document.addEventListener('DOMContentLoaded', loadUsers);

document.getElementById('create-user-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('../php/add_user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(() => {
        this.reset();
        loadUsers();
    });
});