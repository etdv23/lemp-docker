FROM ubuntu:latest

ARG NODE_VERSION=24
ENV NVM_DIR=/app/.nvm
ENV CLAUDE_CONFIG_DIR=/root/.claude

RUN apt update && apt install -y curl git vim php-cli
RUN apt install -y php-mbstring php-mysql php-pgsql php-pdo php-intl php-memcached php-sqlite3 php-bcmath php-decimal php-xml php-zip php-gd php-xdebug
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer
RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm -rf /tmp/composer-setup.php

# The nvm installer requires NVM_DIR to already exist when it is set
RUN mkdir -p $NVM_DIR && curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.2/install.sh | bash

# Install Node and expose it via a stable symlink so PATH doesn't depend on sourcing nvm.sh
RUN bash -c "source $NVM_DIR/nvm.sh && nvm install $NODE_VERSION \
    && ln -sfn \"\$NVM_DIR/versions/node/\$(nvm version default)\" \"\$NVM_DIR/current\""
    
RUN curl -fsSL https://claude.ai/install.sh | bash
RUN curl -fsSL https://opencode.ai/v2/install | bash
RUN curl -fsSL https://openspec.dev/cli/install.sh | bash
RUN curl -fsSL https://raw.githubusercontent.com/rtk-ai/rtk/refs/heads/master/install.sh | bash

# ENV applies to every process, including `docker exec` sessions (which skip ENTRYPOINT/.bashrc)
ENV PATH=/root/.local/bin:/root/.opencode/bin:$NVM_DIR/current/bin:$PATH

WORKDIR /app

# Keep the container alive so users can `docker exec -it <container> bash` into it
CMD ["sleep", "infinity"]
