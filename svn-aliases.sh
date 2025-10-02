# WordPress Plugin SVN Aliases
# Add these to your ~/.zshrc file for permanent access

# SVN Status and Info
alias svnst='svn status'
alias svnup='svn update'
alias svnlog='svn log --limit 10 -v'
alias svninfo='svn info'

# SVN Commits
alias svnci='svn commit -m'
alias svnadd='svn add'

# SVN Diffs
alias svndiff='svn diff'
alias svndiffst='svn diff --summarize'

# Plugin-specific shortcuts (run from plugin directory)
alias plugin-status='cd svn-wp && svn status'
alias plugin-update='cd svn-wp && svn update'
alias plugin-log='cd svn-wp && svn log --limit 10 -v'

# Quick plugin update workflow
alias plugin-copy='cp foa-featured-image-show-caption.php svn-wp/trunk/ && cp readme.txt svn-wp/trunk/ && cp -r assets svn-wp/trunk/'
alias plugin-commit='cd svn-wp && svn commit -m'
alias plugin-tag='cd svn-wp && svn copy trunk'

# Function to create a new plugin version
plugin-version() {
    if [ -z "$1" ]; then
        echo "Usage: plugin-version <version> [commit-message]"
        return 1
    fi
    
    VERSION="$1"
    COMMIT_MSG="${2:-Update to version $VERSION}"
    
    echo "🚀 Updating plugin to version: $VERSION"
    
    # Copy files
    cp foa-featured-image-show-caption.php svn-wp/trunk/
    cp readme.txt svn-wp/trunk/
    cp -r assets svn-wp/trunk/
    
    # Go to SVN directory
    cd svn-wp
    
    # Update and commit
    svn update
    svn add --force .
    svn commit -m "$COMMIT_MSG"
    
    # Create tag
    svn copy trunk "tags/$VERSION"
    svn commit -m "Tagging version $VERSION"
    
    echo "✅ Version $VERSION created successfully!"
    echo "📦 Download: https://downloads.wordpress.org/plugin/foa-featured-image-show-caption.$VERSION.zip"
}

