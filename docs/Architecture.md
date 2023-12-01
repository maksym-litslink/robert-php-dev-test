# Explaining the architecture and design decisions
I used symfony framework for the project.
Created two entities: TranslationUnit and TranslationUnitVersion to store history of changes. Each time TranslationUnit is created/updated, new TranslationUnitVersion is created.
Database schema is generated using doctrine migrations from the entity classes.
I used ApiPlatform to quickly generate CRUD for the entity and generate api docs.
