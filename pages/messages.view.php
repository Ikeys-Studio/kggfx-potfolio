<?php include('../partials/header.php'); ?>
<h2>Contact Messages</h2>

<?php if (empty($messages)): ?>
  <p>No messages found.</p>
<?php else: ?>
  <table border="1" cellpadding="10">
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Message</th>
      <th>Date</th>
    </tr>
    <?php foreach ($messages as $msg): ?>
      <tr>
        <td><?= htmlspecialchars($msg['name']) ?></td>
        <td><?= htmlspecialchars($msg['email']) ?></td>
        <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
        <td><?= $msg['created_at'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>

<?php include('../partials/footer.php'); ?>