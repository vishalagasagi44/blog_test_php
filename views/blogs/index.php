<?php include 'views/layouts/header.php'; ?>
<section class="page-title bg-1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <h1 class="text-capitalize mb-4 text-lg">Blog Articles</h1>
          <!-- Search Bar -->
          <div class="search-bar position-relative">
            <input type="text" id="blogSearch" class="form-control" placeholder="Search for blog articles..." autocomplete="off">
            <i class="search-icon ti-search"></i>
            <div id="searchDropdown" class="dropdown-menu"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section blog-wrap bg-gray">
  <div class="container">
    <div class="row">
      <?php foreach ($posts as $post): ?>
        <div class="col-lg-4 col-md-6 mb-4"> <!-- Three columns -->
          <div class="blog-item">
            <div class="blog-img-wrapper">
              <img src="<?= BASE_ASSET ?>/uploads/<?= $post['image_path'] ?>" alt="" class="img-fluid">
            </div>

            <div class="blog-item-content bg-white p-4">
              <div class="blog-item-meta bg-gray py-1 px-2 mb-2">
                <span class="text-muted text-capitalize"><i class="ti-pencil-alt mr-2"></i><?= $post['category'] ?></span>
                <span class="text-black text-capitalize ml-3"><i class="ti-time mr-1"></i><?= date('jS F, Y', strtotime($post['created_at'])) ?></span>
              </div> 

              <h5 class="mt-2 mb-3"><a href="<?= BASE_DIR ?>/post/<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h5>
              <p><?= substr(htmlspecialchars($post['description']), 0, 100) ?>...</p>
              <a href="<?= BASE_DIR ?>/post/<?= $post['id'] ?>" class="button-48" role="button"><span class="text">Learn More</span></a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="row justify-content-center mt-5">
      <div class="col-lg-6 text-center">
        <nav class="navigation pagination d-inline-block">
          <div class="nav-links">
            <?php if ($currentPage > 1): ?>
              <a class="prev page-numbers" href="?page=<?= $currentPage - 1 ?>"><i class="ti-angle-left"></i> Prev</a>
            <?php endif; ?>

            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
              <a class="page-numbers <?= $page == $currentPage ? 'current' : '' ?>" href="?page=<?= $page ?>"><?= $page ?></a>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
              <a class="next page-numbers" href="?page=<?= $currentPage + 1 ?>">Next <i class="ti-angle-right"></i></a>
            <?php endif; ?>
          </div>
        </nav>
      </div>
    </div>
  </div>
</section>

<?php include 'views/layouts/footer.php'; ?>
