<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Review</h2>

        <form id="editReviewForm" action="{{ route('reviews.update', ['review' => $review]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="commentername">Commenter Name:</label>
                    <input type="text" id="commentername" name="commentername" class="form-control" value="{{ $review->commentername }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="comments">Comments:</label>
                    <textarea id="comments" name="comments" class="form-control">{{ $review->comments }}</textarea>
                </div>
                <div class="form-group col-md-4">
                    <label for="reviewphoto">Review Photo:</label>
                    @if ($review->reviewphoto)
                        <img src="{{ asset('storage/' . $review->reviewphoto) }}" alt="Review Photo" style="max-width: 150px;">
                        <br>
                        <small>Current Photo</small>
                    @else
                        <small>No Photo Available</small>
                    @endif
                    <br>
                    <input type="file" id="reviewphoto" name="reviewphoto" class="form-control-file">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Review</button>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
