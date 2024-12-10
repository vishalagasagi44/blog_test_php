<?php include 'views/layouts/header.php'; ?>
<section class="page-title bg-1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <h1 class="text-capitalize mb-4 text-lg">Blog Articles</h1>
          <!-- Search Bar -->
          <div class="search-bar position-relative">
          <a href="<?= BASE_DIR ?>" class="home-icon">
              <i class="ti-home"></i>
            </a>
            <input type="text" id="blogSearch" class="form-control" placeholder="Search for blog articles..." autocomplete="off">
            <i class="search-icon ti-search"></i>
            <div id="searchDropdown" class="dropdown-menu"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Single Blog Section -->
<section class="section blog-wrap bg-gray"> 
<div class="toast">
  <div class="toast-content">
    <i class="fas fa-solid check"></i>
    <div class="message">
       <span class="text text-2">Your changes has been saved</span>
    </div>
  </div>
  <i class="fa-solid fa-xmark close"></i>
  <div class="progress"></div>
</div> 

  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="row">
          <div class="col-lg-12 mb-5">
            <?php if ($post): ?>
              <div class="single-blog-item">
              <img src="<?= BASE_ASSET ?>/uploads/<?= $post['image_path'] ?>" alt="" class="img-fluid">
                <div class="blog-item-content bg-white p-5">
                  <div class="blog-item-meta bg-gray py-1 px-2">
                    <span class="text-muted text-capitalize mr-3"><i class="ti-pencil-alt mr-2"></i>Category</span>
                    <span class="text-muted text-capitalize mr-3"><i class="ti-comment mr-2"></i><?= count($comments) ?> Comments</span>
                    <span class="text-black text-capitalize mr-3"><i class="ti-time mr-1"></i> <?= date('F j, Y', strtotime($post['created_at'])) ?></span>
                  </div>
                  <h2 class="mt-3 mb-4"><?= htmlspecialchars($post['title']) ?></h2>
                  <p class="lead mb-4"><?= nl2br(htmlspecialchars($post['description'])) ?></p>
                  <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                
                </div>
              </div>
            <?php else: ?>
              <p>Post not found.</p>
            <?php endif; ?>
          </div>

          <!-- Comments Section -->
          <div class="col-lg-12 mb-5">
            <div class="comment-area card border-0 p-5">
              <h4 class="mb-4"><?= count($comments) ?> Comments</h4>
              <ul class="comment-tree list-unstyled">
                <?php if ($comments && count($comments) > 0): ?>
                  <?php foreach ($comments as $comment): ?>
                    <li class="mb-5">
                      <div class="comment-area-box">
                        <img alt="" src="<?= BASE_DIR ?>/public/images/comments.png" class="img-fluid commentsimg float-left mr-3 mt-2">
                        <h5 class="mb-1"><?= htmlspecialchars($comment['commenter_name']) ?></h5>
                        <div class="comment-meta mt-4 mt-lg-0 mt-md-0 float-lg-right float-md-right">
                          <a href="#"><i class="icofont-reply mr-2 text-muted"></i></a>
                          <span class="date-comm">Posted <?= date('F j, Y', strtotime($comment['created_at'])) ?></span>
                        </div>
                        <div class="comment-content mt-3">
                          <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                        </div>
                      </div>
                    </li>
                  <?php endforeach; ?>
                <?php else: ?>
                  <p>No comments yet. Be the first to comment!</p>
                <?php endif; ?>
              </ul>
            </div>
          </div>

          <!-- Comment Form Section -->
          <div class="col-lg-12">
          <form id="commentForm" class="contact-form bg-white rounded p-5" data-post-id="<?= $post['id'] ?>">
          <input type="hidden" id="csrfToken" value="<?= $csrfToken ?>">
            <h4 class="mb-4">Write a comment</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" id="name" placeholder="Name:" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email:" required>
                    </div>
                </div>
            </div>
            <textarea class="form-control mb-3" name="comment" id="comment" cols="30" rows="5" placeholder="Comment" required></textarea>
            <button type="button" id="submitComment" class="btn btn-primary">Submit Comment</button>
        </form>

          </div>

        </div>
      </div>

      <!-- Sidebar Section -->
      <div class="col-lg-4">
        <div class="sidebar-wrap">
         

        <div class="sidebar-widget blogauther card border-0 mb-3">
          <?php if ($author): ?>
              <img src="<?= BASE_DIR ?>/public/images/auther.png" alt="<?= htmlspecialchars($author['name']) ?>" class="img-fluid">
              <div class="card-body p-4 text-center">
                  <h5 class="mb-0 mt-4"><?= htmlspecialchars($author['name']) ?></h5>
                  <p><?= htmlspecialchars($author['designation']) ?></p>
                  <p><?= htmlspecialchars($author['content']) ?></p>
              </div>
          <?php else: ?>
              <p>Author details not available.</p>
          <?php endif; ?>
      </div>

          <div class="sidebar-widget latest-post card border-0 p-6 mb-3">
              <h5 class="mb-4">Latest Posts</h5>
              <?php foreach ($latestPosts as $latestPost): ?>
                  <div class="latest-post-item d-flex align-items-left pb-3 mb-4">
                      <a href="<?= BASE_DIR ?>/post/<?= $latestPost['id'] ?>" class="latest-post-img">
                          <img src="<?= BASE_DIR ?>/public/uploads/<?= $latestPost['image_path'] ?>" alt="<?= htmlspecialchars($latestPost['title']) ?>">
                      </a>
                      <div class="latest-post-content">
                          <h6 class="mb-1"><a href="<?= BASE_DIR ?>/post/<?= $latestPost['id'] ?>"><?= htmlspecialchars($latestPost['title']) ?></a></h6>
                          <span class="text-sm text-muted"><?= date('F j, Y', strtotime($latestPost['created_at'])) ?></span>
                      </div>
                  </div>
              <?php endforeach; ?>
          </div>

          
        </div>
      </div>

    </div>
  </div>
</section>

<?php include 'views/layouts/footer.php'; ?>
