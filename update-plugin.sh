#!/bin/bash

# WordPress Plugin SVN Update Script
# Usage: ./update-plugin.sh [version] [commit-message]

set -e  # Exit on any error

PLUGIN_DIR="/Users/s3m/Projects/Featured Image Caption/wp-content/plugins/foa-featured-image-show-caption"
SVN_DIR="$PLUGIN_DIR/svn-wp"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if we're in the right directory
if [ ! -d "$SVN_DIR" ]; then
    print_error "SVN directory not found: $SVN_DIR"
    exit 1
fi

# Get version from argument or read from plugin file
if [ -n "$1" ]; then
    VERSION="$1"
else
    VERSION=$(grep "Version:" "$PLUGIN_DIR/foa-featured-image-show-caption.php" | sed 's/.*Version: *//' | sed 's/ *$//')
fi

COMMIT_MSG="${2:-Update to version $VERSION}"

print_status "Updating plugin to version: $VERSION"
print_status "Commit message: $COMMIT_MSG"

# Step 1: Copy files to SVN trunk
print_status "Copying files to SVN trunk..."
cp "$PLUGIN_DIR/foa-featured-image-show-caption.php" "$SVN_DIR/trunk/"
cp "$PLUGIN_DIR/readme.txt" "$SVN_DIR/trunk/"
cp -r "$PLUGIN_DIR/assets" "$SVN_DIR/trunk/"

print_success "Files copied to trunk"

# Step 2: Navigate to SVN directory
cd "$SVN_DIR"

# Step 3: Update repository
print_status "Updating SVN repository..."
svn update

# Step 4: Check status
print_status "Checking SVN status..."
svn status

# Step 5: Add any new files
print_status "Adding new files to SVN..."
svn add --force .

# Step 6: Commit to trunk
print_status "Committing to trunk..."
svn commit -m "$COMMIT_MSG"

print_success "Committed to trunk"

# Step 7: Create tag
print_status "Creating tag for version $VERSION..."
svn copy trunk "tags/$VERSION"
svn commit -m "Tagging version $VERSION"

print_success "Created tag: tags/$VERSION"

# Step 8: Update stable tag in readme.txt if needed
CURRENT_STABLE=$(grep "Stable tag:" "$SVN_DIR/trunk/readme.txt" | sed 's/.*Stable tag: *//' | sed 's/ *$//')
if [ "$CURRENT_STABLE" != "$VERSION" ]; then
    print_status "Updating stable tag in readme.txt from $CURRENT_STABLE to $VERSION"
    sed -i '' "s/Stable tag: $CURRENT_STABLE/Stable tag: $VERSION/" "$SVN_DIR/trunk/readme.txt"
    svn commit -m "Update stable tag to $VERSION"
    print_success "Updated stable tag to $VERSION"
fi

print_success "Plugin update completed successfully!"
print_status "Your plugin is now available at:"
print_status "https://wordpress.org/plugins/foa-featured-image-show-caption/"
print_status "Direct download: https://downloads.wordpress.org/plugin/foa-featured-image-show-caption.$VERSION.zip"

