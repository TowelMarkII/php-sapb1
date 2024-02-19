@echo off
@(
    @echo Running in windows environment
    if not exist ../.secrets.env (
        echo Did not find .secrets.env. Will create empty one.
        break > ../.secrets.env
    ) else (
        echo Found .secrets.env. Will not touch it.
    )
)