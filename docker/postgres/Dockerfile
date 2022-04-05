FROM postgres:13.4-alpine

USER postgres

RUN chmod 0700 /var/lib/postgresql/data && \
    initdb /var/lib/postgresql/data && \
    echo "host all all 0.0.0.0/0 md5" >> /var/lib/postgresql/data/pg_hba.conf && \
    echo "listen_addresses='*'" >> /var/lib/postgresql/data/postgresql.conf && \
    pg_ctl start && \
    psql -U postgres -c "CREATE DATABASE todo" && \
    psql -U postgres -c "create user todo with encrypted password 'todo';" && \
    psql -U postgres -c "grant all privileges on database todo to todo;" && \
    psql -c "ALTER USER postgres WITH ENCRYPTED PASSWORD 'todo';"
