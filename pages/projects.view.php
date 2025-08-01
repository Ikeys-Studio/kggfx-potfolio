<?php include('../partials/header.php'); ?>
<h2>Manage Projects</h2>
<button onclick="openAddModal()" class="btn">➕ Add Project</button>

<?php if (empty($projects)): ?>
  <p>No projects added yet.</p>
<?php else: ?>
  <table border="1" cellpadding="10">
    <tr>
      <th>Title</th>
      <th>Description</th>
      <th>Actions</th>
    </tr>
    <?php foreach ($projects as $project): ?>
      <tr>
        <td><?= htmlspecialchars($project['title']) ?></td>
        <td><?= nl2br(htmlspecialchars($project['description'])) ?></td>
        <td>
          <a href="edit_project.php?id=<?= $project['id'] ?>" class="btn">📝 Edit</a>
          <a href="delete_project.php?id=<?= $project['id'] ?>" class="btn" onclick="return confirm('Are you sure you want to delete this project?')">❌ Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>

<!-- Add Project Modal -->
<div id="addModal" class="modal" style="display: none;">
  <div class="modal-content">
    <span class="close" onclick="closeAddModal()">&times;</span>
    <h3>Add New Project</h3>
    <form id="addProjectForm" method="POST" action="add_project.php">
      <input type="text" name="title" placeholder="Project Title" required><br><br>
      <textarea name="description" placeholder="Project Description" rows="4" required></textarea><br><br>
      <input type="text" name="image" placeholder="Image path or URL" required><br><br>
      <button type="submit" class="btn">Save Project</button>
    </form>
  </div>
</div>

<?php include('../partials/footer.php'); ?>