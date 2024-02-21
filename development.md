# Development

This repository is a fork of [syedhussim/php-sapb1](https://github.com/syedhussim/php-sapb1).

To maintain an easy connection with the fork source, the fork master branch will be kept up to date with the source of the fork.  
The forked branch master from the original repository has been renamed to `forks/sayedhussim/php-sapb1/master`  
Other forks are and will be PR'd into their respective fork PR: `forks/[username]/php-sapb1/[branches]`  
We assume that forks only live within github.

This repository uses `main` as its current 'production' branch. Development loosely follows the gitflow workflow.
Development is done in `develop`, releases into `release-[short-commit.yyyyMMdd]` branches. Features, bugs, etc. in `features/[id-feature]`, `bugs/[id-bug]` branches.

Versions are released according to semantic versioning `v[major].[minor].[patch]`. And the commits are tagged with the released version name.

## Git config
The git config requires some special additions to make sure that the forks are easily synchronizeable.

```yaml 
# the working remote and branches
[remote]
	pushDefault = origin
[remote "origin"]
	url = git@github.com:TowelMarkII/php-sapb1.git
	fetch = +refs/heads/*:refs/remotes/origin/*
	pushurl = git@github.com:TowelMarkII/php-sapb1.git
[branch "develop_add-boilerplate-docs"]
	vscode-merge-base = develop_cleanup
	remote = origin
	merge = refs/heads/feature_add-boilerplate-docs
[branch "main"]
	remote = origin
	merge = refs/heads/main

# the source repository of this fork
[branch "forks/syedhussim/php-sapb1/master"]
	remote = origin
	merge = refs/heads/master

# the other forks (remotes) of this repository
# fetch from the other fork (remote)
# push to the working fork (remote)
# fork/remote 1
[branch "forks/dvarelaccpcr/php-sapb1/master"]
	vscode-merge-base = main
	remote = dvarelaccpcr
	merge = refs/heads/forks/dvarelaccpcr/php-sapb1/master
	pushRemote = origin
[remote "dvarelaccpcr"]
	url = git@github.com:dvarelaccpcr/php-sapb1
	fetch = +refs/heads/master:refs/remotes/dvarelaccpcr/master

# fork/remote 2
[branch "forks/emetra-mcmediacom/php-sapb1/master"]
	vscode-merge-base = main
	remote = emetra-mcmediacom
	merge = refs/heads/forks/emetra-mcmediacom/php-sapb1/master
	pushRemote = origin
[remote "emetra-mcmediacom"]
	url = git@github.com:emetra-mcmediacom/php-sapb1
	fetch = +refs/heads/master:refs/remotes/emetra-mcmediacom/master

# fork/remote 3
[branch "forks/jdwiese/php-sapb1/master"]
	vscode-merge-base = main
	remote = jdwiese
	merge = refs/heads/forks/jdwiese/php-sapb1/master
	pushRemote = origin
[remote "jdwiese"]
	url = git@github.com:jdwiese/php-sapb1
	fetch = +refs/heads/master:refs/remotes/jdwiese/master
```

## Developing
This fork is setup to be developed within a vscode .devcontainer.
The .devcontainer has some small modifications to help in development.
Therefore you do need to have Docker or equivalent set up.

### Environment variables
The container requires a .secrets.env file to exist in the root of the workspace.
If the file does not exist, the `{.devcontainer/devcontainer.json}.initializeCommand` will create an empty file.
The specified initializeCommand.cmd file can be run in Windows cmd and Linux bash. It automagically executes the line for the correct shell environment. Any file ending with `*.env` is explicitly excluded using `.gitignore`, because the secrets are meant to be stored there.
The required environment variable secrets are specified in the .env file.

Make sure to add the added environment variables to the `/src/.htaccess` `PassEnv` environment variable list.

DO NOT ADD YOUR SECRETS IN THE `.env` TEMPLATE FILE.
